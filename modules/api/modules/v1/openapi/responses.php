<?php

/**
 * @OA\Response(
 *     response="default",
 *     description="An unexpected error",
 *     @OA\JsonContent(ref="#/components/schemas/Error")
 * )
 *
 * @OA\Response(
 *     response="TeamResponse",
 *     description="Successful operation",
 *     @OA\JsonContent(ref="#/components/schemas/Team")
 * )
 */
