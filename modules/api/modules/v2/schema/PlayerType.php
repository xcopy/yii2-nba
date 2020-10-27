<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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
                    'id' => Type::id(),
                    'name' => Type::string(),
                    'from' => Type::string(),
                    'height' => Type::float(),
                    'weight' => Type::float(),
                    'born_at' => Type::string(),
                    'drafted_at' => Type::string(),
                    'team_id' => Type::id(),
                    'team' => Types::team()
                ];
            }
        ];

        parent::__construct($config);
    }
}
