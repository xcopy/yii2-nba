<?php

namespace app\modules\api\modules\v2\schema;

use Exception;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
// use app\models\Player;
use app\models\Team;

class MutationType extends ObjectType
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $config = [
            'fields' => function(): array {
                return [
                    'createTeam' => [
                        'type' => Types::team(),
                        'args' => [
                            'name' => Type::nonNull(Type::string()),
                            'division_id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => function ($root, $args) {
                            $team = new Team;
                            $team->attributes = $args;
                            $team->insert();

                            return $team;
                        }
                    ],
                    'updateTeam' => [
                        'type' => Types::team(),
                        'args' => [
                            'id' => Type::nonNull(Type::id()),
                            'name' => Type::nonNull(Type::string()),
                            'division_id' => Type::id()
                        ],
                        'resolve' => function ($root, $args) {
                            if ($team = Team::findOne($args['id'])) {
                                $team->attributes = $args;
                                $team->save();

                                return $team;
                            }

                            throw new Exception('Team not found');
                        }
                    ],
                    'deleteTeam' => [
                        'type' => Type::boolean(),
                        'args' => [
                            'id' => Type::nonNull(Type::id())
                        ],
                        'resolve' => function ($root, $args) {
                            if ($team = Team::findOne($args['id'])) {
                                return $team->delete();
                            }

                            throw new Exception('Team not found');
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
