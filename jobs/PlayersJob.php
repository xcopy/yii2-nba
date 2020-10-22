<?php

namespace app\jobs;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Inflector;
use yii\queue\RetryableJobInterface;
use yii\base\View;
use app\models\Team;
use Dompdf\Dompdf;

/**
 * Class PlayersJob.
 */
class PlayersJob extends BaseObject implements RetryableJobInterface
{
    /** @var int */
    public $teamId;

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        $team = Team::findOne($this->teamId);

        $slug = Inflector::slug($team->name, '_', false);
        $filename = sprintf('%s/%s/Players.pdf', Yii::getAlias('@storage'), $slug);

        $html = (new View)->renderFile('@app/jobs/views/players.php', compact('team'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($filename, $dompdf->output());
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
