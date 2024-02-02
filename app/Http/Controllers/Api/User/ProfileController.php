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

    public function show(Request $request)
    {
        return ProfileResource::make($request->user());
    }

    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        $user = User::findOrFail($request->user()->id);
        return ProfileResource::make($user);
    }
}
