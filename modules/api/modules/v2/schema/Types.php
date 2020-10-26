<?php

namespace app\modules\api\modules\v2\schema;

class Types
{
    /**
     * @return PlayerType
     */
    public static function player()
    {
        return new PlayerType;
    }

    /**
     * @return TeamType
     */
    public static function team()
    {
        return new TeamType;
    }
}
