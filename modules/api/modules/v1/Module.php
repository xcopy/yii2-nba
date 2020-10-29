<?php

namespace app\modules\api\modules\v1;

use Yii;
use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }
}
