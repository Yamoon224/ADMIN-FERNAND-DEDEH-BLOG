<?php

namespace App\Models\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *     title="Comment",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="comments", type="string"),
 *     @OA\Property(property="question_id", type="integer"),
 *     @OA\Property(property="created_by", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class CommentSchema {}
