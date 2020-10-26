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
 *         enum={"json","xml"},
 *         default="json"
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
 * @OA\Schema(
 *     schema="id",
 *     type="integer",
 *     format="int64"
 * )
 *
 * @OA\Schema(
 *     schema="name",
 *     type="string"
 * )
 *
 * @OA\Schema(
 *     schema="date",
 *     type="string",
 *     format="date"
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
