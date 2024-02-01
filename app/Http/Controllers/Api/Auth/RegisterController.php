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

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return response()->json([
            'success' => 'Check your email and click on the link to verify.'
        ], Response::HTTP_CREATED);
    }
}
