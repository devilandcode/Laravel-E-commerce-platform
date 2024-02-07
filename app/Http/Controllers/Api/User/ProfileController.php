<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ProfileEditRequest;
use App\Http\Resources\User\ProfileResource;
use App\Models\User\User;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     summary="Show User params",
     *     tags={"Profile"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="email", type="string", example="tom@gmail.com")),
     *             @OA\Property(property="phone", type="object",
     *                 @OA\Property(property="number", type="string", example="7203763345")),
     *                 @OA\Property(property="verified", type="boolean", example="true")),
     *             ),
     *             @OA\Property(property="name", type="object",
     *                 @OA\Property(property="first", type="string", example="Tom")),
     *                 @OA\Property(property="last", type="string", example="Tailor")),
     *             ),
     *         ),
     *     ),
     * ),
     */
    public function show(Request $request)
    {

        return ProfileResource::make(auth('api')->user());
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     summary="Fill User's name, last name and phone",
     *     tags={"Profile"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                      @OA\Property(property="name", type="string", example="Tom"),
     *                      @OA\Property(property="last_name", type="string", example="Tailor"),
     *                      @OA\Property(property="phone", type="string", example="7203763345"),
     *                 ),
     *             },
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="email", type="string", example="tom@gmail.com")),
     *                 @OA\Property(property="phone", type="object",
     *                     @OA\Property(property="number", type="string", example="7203763345")),
     *                     @OA\Property(property="verified", type="boolean", example="true")),
     *                 ),
     *                 @OA\Property(property="name", type="object",
     *                     @OA\Property(property="first", type="string", example="Tom")),
     *                     @OA\Property(property="last", type="string", example="Tailor")),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="422", description="Validation errors"),
     * )
     */
    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        $user = User::findOrFail($request->user()->id);
        return ProfileResource::make($user);
    }
}
