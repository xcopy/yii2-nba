<?php

namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\HttpBearerAuth;
use app\modules\api\modules\v1\models\Team;
use app\models\User;

/**
 * @OA\Get(
 *     path="/team",
 *     summary="Get teams",
 *     tags={"team"},
 *     security={
 *         {"basicAuth": {}}
 *     },
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
 *     tags={"team"},
 *     security={
 *         {"apiKey": {}}
 *     },
 *     @OA\RequestBody(ref="#/components/requestBodies/TeamRequestBody"),
 *     @OA\Response(response="200",ref="#/components/responses/TeamResponse"),
 *     @OA\Response(response="default",ref="#/components/responses/default"),
 * )
 *
 * @OA\Put(
 *     path="/team/update",
 *     summary="Update a team",
 *     tags={"team"},
 *     security={
 *         {"apiKey": {}}
 *     },
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(ref="#/components/requestBodies/TeamRequestBody"),
 *     @OA\Response(response="200",ref="#/components/responses/TeamResponse"),
 *     @OA\Response(response="default",ref="#/components/responses/default"),
 * )
 *
 * @OA\Delete(
 *     path="/team/delete",
 *     summary="Delete a team",
 *     tags={"team"},
 *     security={
 *         {"bearerAuth": {}}
 *     },
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="204",description="Deleted successfully"),
 *     @OA\Response(response="default",ref="#/components/responses/default")
 * )
 */
class TeamController extends ActiveController
{
    /** @var string */
    public $modelClass = Team::class;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::class,
                    'auth' => function (string $username, string $password) {
                        $user = User::findByUsername($username);
                        return $user->validatePassword($password) ? $user : null;
                    }
                ],
                HttpHeaderAuth::class,
                HttpBearerAuth::class
            ],
            // 'only' => [],
            // 'except' => []
        ];

        return $behaviors;
    }
}
