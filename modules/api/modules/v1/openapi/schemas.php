<?php

/**
 * @OA\Schema(schema="id",type="integer",format="int64",minimum=1)
 * @OA\Schema(schema="name",type="string")
 * @OA\Schema(schema="date",type="string",format="date")
 *
 * @OA\Schema(
 *     schema="Error",
 *     type="object",
 *     @OA\Property(property="name",type="string"),
 *     @OA\Property(property="message",type="string"),
 *     @OA\Property(property="code",type="integer"),
 *     @OA\Property(property="status",type="integer"),
 *     @OA\Property(property="type",type="string"),
 *     required={"name","message","code","status","type"}
 * )
 *
 * @OA\Schema(
 *     schema="ArrayOfPlayers",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Player")
 * )
 *
 * @OA\Schema(
 *     schema="ArrayOfTeams",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Team")
 * )
 */