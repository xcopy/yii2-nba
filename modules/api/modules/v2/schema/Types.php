<?php

namespace app\modules\api\modules\v2\schema;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;

/**
 * @link https://webonyx.github.io/graphql-php/type-system/#type-registry
 */
class Types
{
    /** @var PlayerType */
    private static $player;

    /** @var TeamType */
    private static $team;

    /** @var QueryType */
    private static $query;

    /** @var MutationType */
    private static $mutation;

    /** @var ListOfType */
    private static $validationErrors;

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

    /**
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType);
    }

    /**
     * @return MutationType
     */
    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType);
    }

    /**
     * @return ListOfType
     */
    public static function validationErrors()
    {
        return self::$validationErrors ?: (self::$validationErrors = Type::listOf(Type::string()));
    }
}
