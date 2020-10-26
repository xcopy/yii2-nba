<?php

namespace app\modules\api\modules\v2\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;
use yii\rest\ActiveController;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use app\modules\api\v2\schema\QueryType;

class GraphqlController extends ActiveController
{
    public function actionIndex()
    {
        $query = Yii::$app->request->get('query', Yii::$app->request->post('query'));
        $variables = Yii::$app->request->get('variables', Yii::$app->request->post('variables'));
        $operation = Yii::$app->request->get('operation', Yii::$app->request->post('operation', null));

        if (empty($query)) {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);

            $query = $input['query'];
            $variables = $input['variables'] ?? [];
            $operation = $input['operation'] ?? null;
        }

        if (! empty($variables) && ! is_array($variables)) {
            try {
                $variables = Json::decode($variables);
            } catch (InvalidArgumentException $e) {
                $variables = null;
            }
        }

        $schema = new Schema(['query' => new QueryType]);

        return GraphQL::executeQuery(
            $schema,
            $query,
            null,
            null,
            empty($variables) ? null : $variables,
            empty($operation) ? null : $operation
        )->toArray();
    }
}
