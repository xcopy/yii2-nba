<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Player;

class PlayerController extends ActiveController
{
    /** @var string */
    public $modelClass = Player::class;
}
