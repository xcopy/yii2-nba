<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Team;

/**
 * @OA\Get(
 *     path="/team",
 *     @OA\Parameter(ref="#/components/parameters/page"),
 *     @OA\Parameter(ref="#/components/parameters/sort"),
 *     @OA\Parameter(ref="#/components/parameters/expand"),
 *     @OA\Response(
 *         response="200",
 *         description="Paginated list of teams",
 *         @OA\JsonContent(ref="#/components/schemas/ArrayOfTeams")
 *     )
 * )
 */
class TeamController extends ActiveController
{
    /** @var string */
    public $modelClass = Team::class;
}
