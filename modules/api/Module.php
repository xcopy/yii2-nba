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
 *
 * @OA\Parameter(
 *     parameter="id",
 *     name="id",
 *     in="query",
 *     required=true,
 *     @OA\Schema(type="integer",format="int64",minimum=1)
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
 *
 * @OA\Schema(
 *     schema="Error",
 *     type="object",
 *     @OA\Property(property="name",type="string"),
 *     @OA\Property(property="message",type="string"),
 *     @OA\Property(property="code",type="integer"),
 *     @OA\Property(property="status",type="integer"),
 *     @OA\Property(property="type",type="string"),
 *     required={"name","message","code","status","type"}
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
