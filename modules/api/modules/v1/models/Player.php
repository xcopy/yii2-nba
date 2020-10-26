<?php

namespace app\modules\api\modules\v1\models;

use app\models\Player as BasePlayer;

/**
 * @OA\Schema(
 *     @OA\Property(property="id",ref="#/components/schemas/id"),
 *     @OA\Property(property="name",ref="#/components/schemas/name"),
 *     @OA\Property(property="from",type="string"),
 *     @OA\Property(property="height",type="number",format="double"),
 *     @OA\Property(property="weight",type="number",format="double"),
 *     @OA\Property(property="born_at",ref="#/components/schemas/date"),
 *     @OA\Property(property="drafted_at",ref="#/components/schemas/date"),
 *     @OA\Property(property="team_id",ref="#/components/schemas/id"),
 *     @OA\Property(property="team",ref="#/components/schemas/Team"),
 *     required={"name","from","height","weight","born_at","drafted_at","team_id"}
 * )
 */
class Player extends BasePlayer
{
    /**
     * @inheritDoc
     */
    public function extraFields()
    {
        return ['team'];
    }
}
