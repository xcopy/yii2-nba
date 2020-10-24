<?php

namespace app\modules\api;

use Yii;
use yii\base\Module as BaseModule;

/**
 * @OA\Parameter(
 *     parameter="_format",
 *     name="_format",
 *     in="query",
 *     required=false,
 *     @OA\Schema(
 *         type="string",
 *         enum={"xml","json"},
 *         default="xml"
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="page",
 *     name="page",
 *     in="query",
 *     required=false,
 *     @OA\Schema(
 *         type="integer",
 *         format="int64",
 *         default=1
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="sort",
 *     name="sort",
 *     in="query",
 *     required=false,
 *     @OA\Schema(
 *         type="string",
 *         default="id"
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="expand",
 *     name="expand",
 *     in="query",
 *     required=false,
 *     @OA\Schema(type="string")
 * )
 */

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
