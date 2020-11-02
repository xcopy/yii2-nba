<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;

class TeamErrorsType extends ObjectType
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'name' => Types::errors(),
                'division_id' => Types::errors()
            ]
        ]);
    }
}
