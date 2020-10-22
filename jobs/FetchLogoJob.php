<?php

namespace app\jobs;

use RuntimeException;
use Yii;
use yii\base\BaseObject;
use yii\queue\RetryableJobInterface;
use yii\helpers\Inflector;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use app\models\Team;

/**
 * Class FetchLogoJob.
 */
class FetchLogoJob extends BaseObject implements RetryableJobInterface
{
    /** @var int */
    public $teamId;

    /**
     * @inheritdoc
     * @throws GuzzleException
     * @throws RuntimeException
     */
    public function execute($queue)
    {
        if ($team = Team::findOne($this->teamId)) {
            $http = new HttpClient;

            $slug = Inflector::slug($team->name, '_', false);

            $json = $http->get('https://en.wikipedia.org/api/rest_v1/page/media-list/'.$slug)
                ->getBody();

            $data = json_decode($json);

            $dir = Yii::getAlias('@storage').'/'.$slug.'/Logo';

            is_dir($dir) or mkdir($dir, 0755, true);

            if ($data->items[0] && $data->items[0]->srcset) {
                foreach ($data->items[0]->srcset as $i => $set) {
                    $filename = $dir.'/Logo-'.$i.'.'.pathinfo(basename($set->src), PATHINFO_EXTENSION);

                    file_exists($filename) or $http->get($set->src, [
                        RequestOptions::SINK => $filename
                    ]);
                }
            }
        } else {
            throw new RuntimeException('Team not found');
        }
    }

    /**
     * @inheritdoc
     */
    public function getTtr()
    {
        return 60;
    }

    /**
     * @inheritdoc
     */
    public function canRetry($attempt, $error)
    {
        return $attempt < 3;
    }
}
