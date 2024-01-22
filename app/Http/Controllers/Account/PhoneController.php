<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\Sms\SmsSenderInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function __construct(
        private SmsSenderInterface $sms,
    )
    {
    }

    public function request()
    {
        $user = Auth::user();

        try {
            $token = $user->requestPhoneVerification(Carbon::now());
            $this->sms->send($user->phone, 'Token: ' . $token);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('account.profile.phone');
    }

    public function form()
    {
        $user = Auth::user();

        return view('account.profile.phone', compact('user'));
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        try {
            $user->verifyPhone($request['token'], Carbon::now());
        } catch (\DomainException $e) {
            return redirect()->route('account.profile.phone')->with('error', $e->getMessage());
        }

        return redirect()->route('account.profile.home')->with('success', 'Your phone is verified');
    }

//    public function auth()
//    {
//        $this->service->toggleAuth(Auth::id());
//
//        return redirect()->route('cabinet.profile.home');
//    }
}
