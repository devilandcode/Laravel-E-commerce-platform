<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Mail\Auth\VerifyMail;
use App\Models\User;
use App\Services\Auth\RegisterService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{


    public function __construct(private RegisterService $service)
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return redirect()->route('login')
            ->with('success', 'Check your Email and click on the link to verify');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry your link cannot be identified.');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')
                ->with('success', 'Your email is verified. You can now login');
        } catch (\DomainException $e) {
            return redirect()->route('login')
                ->with('error', $e->getMessage());
        }
    }
}
