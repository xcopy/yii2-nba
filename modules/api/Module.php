<?php

namespace app\modules\api;

use Yii;
use yii\base\Module as BaseModule;

/**
 * @OA\Info(
 *     title="Yii2 NBA API",
 *     description="Awesome NBA API server",
 *     version="0.1",
 *     @OA\Contact(
 *         email="support@localhost"
 *     )
 * )
 * @OA\Server(
 *     url="http://localhost:8080/api/v1",
 *     description="Local API server"
 * )
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::configure($this, require __DIR__ . '/config.php');
    }
}
