<?php

namespace app\modules\api\modules\v1\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}
