<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ValidationErrorsType extends ObjectType
{
    /**
     * Initialize model validation errors
     *
     * @param Type $type
     * @param array $fields
     * @return void
     */
    public function __construct(Type $type, array $fields = [])
    {
        parent::__construct([
            'name' => $type->name.'ValidationErrors',
            'fields' => function () use ($type, $fields): array {
                $output = [];

                $fields = empty($fields) ? array_keys($type->getFields()) : $fields;

                foreach ($fields as $field) {
                    $output[$field] = Types::validationErrors();
                }

                if (isset($output['_errors'])) {
                    unset($output['_errors']);
                }

                return $output;
            }
        ]);
    }
}
