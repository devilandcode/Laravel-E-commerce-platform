<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher as DispatcherInterface;
use Illuminate\Contracts\Mail\Mailer as MailerInterface;

class RegisterService
{
    public function __construct(
        private MailerInterface $mailer,
        private DispatcherInterface $dispatcher )
    {
    }
    public function register(RegisterRequest $request): void
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->verify();
    }
}
