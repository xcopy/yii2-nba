<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Team;

class TeamController extends ActiveController
{
    /** @var string */
    public $modelClass = Team::class;
}