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
 *     ),
 *     @OA\Response(response="default",ref="#/components/responses/default")
 * )
 *
 * @OA\Post(
 *     path="/team/create",
 *     summary="Create new team",
 *     @OA\RequestBody(ref="#/components/requestBodies/TeamRequestBody"),
 *     @OA\Response(response="200",ref="#/components/responses/TeamResponse"),
 *     @OA\Response(response="default",ref="#/components/responses/default"),
 * )
 *
 * @OA\Put(
 *     path="/team/update",
 *     summary="Update a team",
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(ref="#/components/requestBodies/TeamRequestBody"),
 *     @OA\Response(response="200",ref="#/components/responses/TeamResponse"),
 *     @OA\Response(response="default",ref="#/components/responses/default"),
 * )
 *
 * @OA\Delete(
 *     path="/team/delete",
 *     summary="Delete a team",
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="204",description="Deleted successfully"),
 *     @OA\Response(response="default",ref="#/components/responses/default")
 * )
 */
class TeamController extends ActiveController
{
    /** @var string */
    public $modelClass = Team::class;
}
