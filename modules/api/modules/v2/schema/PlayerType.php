<?php

namespace app\modules\api\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\Player;

class PlayerType extends ObjectType
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $config = [
            'fields' => function (): array {
                return [
                    'id' => ['type' => Type::id()],
                    'name' => ['type' => Type::string()],
                    'from' => ['type' => Type::string()],
                    'height' => ['type' => Type::float()],
                    'weight' => ['type' => Type::float()],
                    'born_at' => [
                        'type' => Type::string(),
                        'args' => [
                            'format' => Type::string(),
                            'resolve' => function (Player $player, $args): string {
                                return isset($args['format'])
                                    ? date($args['format'], strtotime($player->born_at))
                                    : $player->born_at;
                            }
                        ]
                    ],
                    'drafted_at' => ['type' => Type::string()],
                    'team_id' => ['type' => Type::id()],
                    'team' => ['type' => Types::team()]
                ];
            }
        ];

        parent::__construct($config);
    }
}
