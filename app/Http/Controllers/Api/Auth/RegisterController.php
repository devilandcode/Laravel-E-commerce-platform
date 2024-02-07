<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __construct(
        private RegisterService $service
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Register User",
     *     tags={"Register"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                      @OA\Property(property="name", type="string", example="Tom"),
     *                      @OA\Property(property="email", type="string", example="tom@gmail.com"),
     *                      @OA\Property(property="password", type="string", example="tom123456"),
     *                      @OA\Property(property="password_confirmation", type="string", example="tom123456"),
     *                 ),
     *             },
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="success",
     * 		           type="string",
     *                 example="success: Check your email and click on the link to verify."
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return response()->json([
            'success' => 'Check your email and click on the link to verify.'
        ], Response::HTTP_CREATED);
    }
}
