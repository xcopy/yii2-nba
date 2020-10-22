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
use app\jobs\PlayersJob;
use app\models\Team;

class TeamController extends Controller
{
    /** @var Queue */
    private $queue;

    /** @var int */
    private $jobsPushed = 0;

    /** @var array */
    private $teamIds = [];

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->queue = Yii::$app->get('queue');
        $this->teamIds = ArrayHelper::getColumn(Team::find()->all(), 'id');

        parent::init();
    }

    /**
     * @inheritDoc
     */
    public function afterAction($action, $result)
    {
        $this->stdout($this->jobsPushed." job(s) pushed into queue\n", Console::FG_GREEN);

        return parent::afterAction($action, $result);
    }

    /**
     * @param mixed $teamId
     * @return int
     */
    public function actionFetchLogos($teamId = null)
    {
        $ids = $teamId ? [$teamId] : $this->teamIds;

        foreach ($ids as $i => $id)
        {
            $delay = ($i + 1) * env('QUEUE_DELAY');

            $this->queue->delay($delay)->push(new FetchLogoJob(['teamId' => $id]));

            $this->jobsPushed++;
        }

        return ExitCode::OK;
    }

    /**
     * @param mixed $teamId
     * @return int
     */
    public function actionPlayers($teamId = null)
    {
        $ids = $teamId ? [$teamId] : $this->teamIds;

        foreach ($ids as $i => $id)
        {
            $delay = ($i + 1) * env('QUEUE_DELAY');

            $this->queue->delay($delay)->push(new PlayersJob(['teamId' => $id]));

            $this->jobsPushed++;
        }

        return ExitCode::OK;
    }
}
