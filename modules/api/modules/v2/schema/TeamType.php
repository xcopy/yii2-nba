<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class TeamType extends ObjectType
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
                    'players' => Type::listOf(new PlayerType)
                    // OR 'players' => Type::listOf(Types::player())
                ];
            }
        ];

        parent::__construct($config);
    }
}
