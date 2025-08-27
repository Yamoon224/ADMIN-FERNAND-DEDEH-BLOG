<?php

namespace App\Http\Controllers\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="My Laravel API",
 *     version="1.0.0",
 *     description="Documentation for My Laravel API"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class SwaggerController
{
    // Ce fichier peut rester vide, il sert juste pour les annotations globales
}
