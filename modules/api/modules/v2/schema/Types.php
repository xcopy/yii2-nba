<?php

namespace app\modules\api\modules\v2\schema;

/**
 * @link https://webonyx.github.io/graphql-php/type-system/#type-registry
 */
class Types
{
    /** @var PlayerType */
    private static $player;

    /** @var TeamType */
    private static $team;

    /**
     * @return PlayerType
     */
    public static function player()
    {
        return self::$player ?: (self::$player = new PlayerType);
    }

    /**
     * @return TeamType
     */
    public static function team()
    {
        return self::$team ?: (self::$team = new TeamType);
    }
}
