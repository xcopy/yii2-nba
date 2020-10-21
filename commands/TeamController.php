<?php

namespace app\commands;

use Yii;
use yii\helpers\Console;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\queue\file\Queue;
use app\jobs\FetchLogoJob;
use app\models\Team;

class TeamController extends Controller
{
    /**
     * Fetch logo images for the given team or for all of them.
     * @param mixed $teamId
     * @return int
     * @throws InvalidConfigException
     */
    public function actionFetchLogos($teamId = null)
    {
        /** @var Queue $queue */
        $queue = Yii::$app->get('queue');

        $ids = $teamId ? [$teamId] : ArrayHelper::getColumn(Team::find()->all(), 'id');

        foreach ($ids as $id) {
            $queue->push(new FetchLogoJob(['teamId' => $id]));
        }

        $this->stdout(count($ids)." job(s) pushed into queue\n", Console::FG_GREEN);

        return ExitCode::OK;
    }
}
