<?php

namespace app\modules\api\modules\v1\models;

use app\models\Team as BaseTeam;

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
