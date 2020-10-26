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
                    'player' => [
                        'type' => new PlayerType,
                        // OR 'type' => Types::player()
                        'args' => [
                            'id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => function ($root, $args): Player {
                            return Player::findOne($args['id']);
                        }
                    ],
                    'team' => [
                        'type' => new TeamType,
                        'args' => [
                            'id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => function ($root, $args): Team {
                            return Team::findOne($args['id']);
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
