<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info( title="API Plantilla", version="1.0",
 *   description="Backend Documentación"
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="token",
 *      type="apiKey",
 *      name="Authorization",
 *      in="header"
 *     ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
