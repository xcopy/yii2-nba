<?php

/**
 * @OA\Parameter(
 *     parameter="_format",
 *     name="_format",
 *     in="query",
 *     required=false,
 *     @OA\Schema(
 *         type="string",
 *         enum={"json","xml"},
 *         default="json"
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="page",
 *     name="page",
 *     in="query",
 *     required=false,
 *     @OA\Schema(type="integer",format="int64",minimum=1)
 * )
 *
 * @OA\Parameter(
 *     parameter="sort",
 *     name="sort",
 *     in="query",
 *     required=false,
 *     @OA\Schema(type="string")
 * )
 *
 * @OA\Parameter(
 *     parameter="expand",
 *     name="expand",
 *     in="query",
 *     required=false,
 *     @OA\Schema(type="string")
 * )
 *
 * @OA\Parameter(
 *     parameter="id",
 *     name="id",
 *     in="query",
 *     required=true,
 *     @OA\Schema(type="integer",format="int64",minimum=1)
 * )
 */
