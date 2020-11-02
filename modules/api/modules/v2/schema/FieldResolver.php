<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ResolveInfo;
use yii\base\Model;

/**
 * Default field resolver class for ActiveRecord models.
 */
class FieldResolver
{
    /**
     * Return (resolve) specific value for a field.
     * This one is a default resolver for models.
     * Fell free to define a custom resolver per model.
     *
     * @param Model $model
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @return array|mixed
     */
    public function __invoke(Model $model, $args, $context, ResolveInfo $info)
    {
        return $info->fieldName === '_errors'
            ? $model->errors
            : $model->{$info->fieldName};
    }
}
