<?php

namespace app\modules\api\modules\v1\models;

use app\models\Player as BasePlayer;

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
