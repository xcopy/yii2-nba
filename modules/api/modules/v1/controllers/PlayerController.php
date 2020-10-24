<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Player;

/**
 * @OA\Get(
 *     path="/player",
 *     @OA\Parameter(
 *         in="query",
 *         name="_format",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             oneOf={"xml","json"}
 *         )
 *     ),
 *     @OA\Parameter(
 *         in="query",
 *         name="page",
 *         required=false,
 *         @OA\Schema(
 *             type="int",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Parameter(
 *         in="query",
 *         name="sort",
 *         required=false,
 *         examples={"&sort=-id","&sort=+name"},
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         in="query",
 *         name="expand",
 *         description="Expands relationships",
 *         required=false,
 *         example="&expand=team",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Paginated list of the players"
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="An unexpected error"
 *     )
 * )
 */
class PlayerController extends ActiveController
{
    /** @var string */
    public $modelClass = Player::class;
}
