<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Swagger(
 *     basePath="/api",
 *     host="localhost",
 *     schemes={"http"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Board API",
 *         description="HTTP JSON API",
 *     ),
 *     @OA\SecurityScheme(
 *         securityDefinition="OAuth2",
 *         type="oauth2",
 *         flow="password",
 *         tokenUrl="http://localhost/oauth/token"
 *     ),
 *     @OA\SecurityScheme(
 *         securityDefinition="Bearer",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header"
 *     ),
 *     @OA\Definition(
 *         definition="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @OA\Property(
 *             property="code",
 *             type="integer",
 *         ),
 *         @OA\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */


class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Info"},
     *     @OA\Response(
     *          response="200",
     *          description="API version")
     *          @OA\Schema(
     *             type="object",
     *             @OA\Property(property="version", type="string")
     *         ),
     * )
     */
    public function home()
    {
        return [
          'name' => 'Board Api',
        ];
    }
}
