<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Player;

/**
 * @OA\Get(
 *     path="/player",
 *     summary="Get players",
 *     tags={"player"},
 *     @OA\Parameter(ref="#/components/parameters/page"),
 *     @OA\Parameter(ref="#/components/parameters/sort"),
 *     @OA\Parameter(ref="#/components/parameters/expand"),
 *     @OA\Response(
 *         response="200",
 *         description="Paginated list of players",
 *         @OA\JsonContent(ref="#/components/schemas/ArrayOfPlayers")
 *     ),
 *     @OA\Response(response="default",ref="#/components/responses/default")
 * )
 *
 * @OA\Get(
 *     path="/player/view",
 *     summary="Get player details",
 *     tags={"player"},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Parameter(ref="#/components/parameters/expand"),
 *     @OA\Response(
 *         response="200",
 *         description="Player details",
 *         @OA\JsonContent(ref="#/components/schemas/Player")
 *     ),
 *     @OA\Response(response="default",ref="#/components/responses/default")
 * )
 */
class PlayerController extends ActiveController
{
    /** @var string */
    public $modelClass = Player::class;
}
