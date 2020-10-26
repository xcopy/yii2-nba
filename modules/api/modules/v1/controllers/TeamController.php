<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use app\modules\api\modules\v1\models\Team;

/**
 * @OA\Get(
 *     path="/team",
 *     summary="Get all teams",
 *     @OA\Parameter(ref="#/components/parameters/page"),
 *     @OA\Parameter(ref="#/components/parameters/sort"),
 *     @OA\Parameter(ref="#/components/parameters/expand"),
 *     @OA\Response(
 *         response="200",
 *         description="Paginated list of teams",
 *         @OA\JsonContent(ref="#/components/schemas/ArrayOfTeams")
 *     )
 * )
 *
 * @OA\Post(
 *     path="/team/create",
 *     summary="Create new team",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(ref="#/components/schemas/Team")
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Team")
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="An unexpected error",
 *         @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
class TeamController extends ActiveController
{
    /** @var string */
    public $modelClass = Team::class;
}
