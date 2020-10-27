<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
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
                        'resolve' => fn (): array => Player::find()->all()
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
