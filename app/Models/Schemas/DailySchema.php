<?php

namespace App\Models\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Daily",
 *     type="object",
 *     title="Daily",
 *     description="Schema for Daily model",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="introduction", type="string"),
 *     @OA\Property(property="published_at", type="string", format="date-time"),
 *     @OA\Property(property="created_by", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class DailySchema {}
