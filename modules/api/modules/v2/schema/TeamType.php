<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use app\models\Team;

class TeamType extends ObjectType
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $config = [
            'fields' =>  [
                'id' => Type::int(),
                'name' => Type::string(),
                'division_id' => Type::int(),
                'players' => Type::listOf(Types::player()),
                '_errors' => new ValidationErrorsType($this)
            ],
            'resolveField' => new FieldResolver
        ];

        parent::__construct($config);
    }
}
