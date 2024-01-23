<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileEditRequest;
use App\UseCases\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
//    private $service;
//
//    public function __construct(ProfileService $service)
//    {
//        $this->service = $service;
//    }

    public function index()
    {
        $user = Auth::user();

        return view('account.profile.home', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('account.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|regex:/^\d+$/s'
        ]);

        $user = Auth::user();

        $oldPhone = $user->phone;

        $user->update($validated);

        if ($user->phone !== $oldPhone) {
            $user->unverifyPhone();
        }

        return redirect()->route('account.profile.home');
    }
}
