<?php

namespace app\modules\api\modules\v1\models;

use app\models\Team as BaseTeam;

/**
 * @OA\Schema(
 *     @OA\Property(property="id",ref="#/components/schemas/id"),
 *     @OA\Property(property="name",ref="#/components/schemas/name"),
 *     @OA\Property(property="division_id",ref="#/components/schemas/id"),
 *     required={"id","name","division_id"}
 * )
 */
class Team extends BaseTeam
{
    /**
     * @inheritDoc
     */
    public function extraFields()
    {
        return ['division', 'players', 'managers'];
    }
}
