<?php

namespace app\modules\api\modules\v2\schema;

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
                            'name' => Type::string(),
                            'division_id' => Type::id()
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
                            'id' => Type::id(),
                            'name' => Type::string(),
                            'division_id' => Type::id()
                        ],
                        'resolve' => function ($root, $args) {
                            $team = Team::findOne($args['id']);
                            $team->attributes = $args;
                            $team->save();

                            return $team;
                        }
                    ],
                    'deleteTeam' => [
                        'type' => Type::boolean(),
                        'args' => [
                            'id' => Type::id()
                        ],
                        'resolve' => fn ($root, $args) => (bool) Team::findOne($args['id'])->delete()
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
