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
                    'id' => Type::id(),
                    'name' => Type::string(),
                    'division_id' => Type::id(),
                    'players' => Type::listOf(Types::player()),
                    'errors' => new ValidationErrorsType($this)
                ];
            }
        ];

        parent::__construct($config);
    }
}
