<?php

namespace app\modules\api\modules\v1;

use yii\base\Module as BaseModule;

/**
 * @OA\Response(
 *     response="Player",
 *     description="A Player object",
 *     @OA\JsonContent(ref="#/components/schemas/Player")
 * )
 */

/**
 * @OA\Schema(
 *     schema="ArrayOfPlayers",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Player")
 * )
 */

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
