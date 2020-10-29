<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use yii\data\Pagination;
use app\models\Player;
use app\models\Team;

class QueryType extends ObjectType
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $config = [
            'fields' => function (): array {
                return [
                    'players' => [
                        'type' => Type::listOf(Types::player()),
                        'args' => [
                            'page' => [
                                'type' => Type::int(),
                                'defaultValue' => 1
                            ]
                        ],
                        'resolve' => function ($root, $args) {
                            $query = Player::find();

                            $pagination = new Pagination([
                                'totalCount' => (clone $query)->count()
                            ]);

                            $pagination->setPage($args['page'] - 1, true);

                            return $query->offset($pagination->offset)
                                ->limit($pagination->limit)
                                ->all();
                        }
                    ],
                    'player' => [
                        'type' => Types::player(),
                        'args' => [
                            'id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => fn ($root, $args): Player => Player::findOne($args['id'])
                    ],
                    'teams' => [
                        'type' => Type::listOf(Types::team()),
                        'resolve' => fn (): array => Team::find()->all()
                    ],
                    'team' => [
                        'type' => Types::team(),
                        'args' => [
                            'id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => fn ($root, $args): Team => Team::findOne($args['id'])
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
