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
     *     tags={"Profile"},
     *     @OA\Parameter(name="body", in="body", required=true, @OA\Schema(ref="#/definitions/RegisterRequest")),
     *     @OA\Response(
     *         response=201,
     *         description="Success response",
     *     )
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
