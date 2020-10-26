<?php

namespace app\modules\api\modules\v1;

use yii\base\Module as BaseModule;

/**
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
    }
}
