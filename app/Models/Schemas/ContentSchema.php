<?php

namespace App\Models\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Content",
 *     type="object",
 *     title="Content",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="body", type="string"),
 *     @OA\Property(property="hashtag_id", type="integer"),
 *     @OA\Property(property="path_image", type="string", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ContentSchema {}
