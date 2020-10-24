<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Player;

/**
 * @OA\Get(
 *     path="/player",
 *     @OA\Parameter(ref="#/components/parameters/_format"),
 *     @OA\Parameter(ref="#/components/parameters/page"),
 *     @OA\Parameter(ref="#/components/parameters/sort"),
 *     @OA\Parameter(ref="#/components/parameters/expand"),
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
