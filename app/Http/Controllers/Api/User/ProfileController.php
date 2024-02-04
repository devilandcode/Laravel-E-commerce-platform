<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ProfileEditRequest;
use App\Http\Resources\User\ProfileResource;
use App\Models\User\User;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(ref="#/definitions/Profile"),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function show(Request $request)
    {
        return ProfileResource::make($request->user());
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\Parameter(name="body", in="body", required=true, @OA\Schema(ref="#/definitions/ProfileEditRequest")),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        $user = User::findOrFail($request->user()->id);
        return ProfileResource::make($user);
    }
}
