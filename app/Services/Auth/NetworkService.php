<?php

namespace App\Services\Auth;

use App\Models\User\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as NetworkUser;

class NetworkService
{
    public function auth(string $network, NetworkUser $data): User
    {
        if ($user = User::byNetwork($network, $data->getId())->first()) {
            return $user;
        }

        if ($data->getEmail() && $user = User::where('email', $data->getEmail())->exists()) {
            throw new \DomainException('User with this email is already registered.');
        }

        $user = DB::transaction(function () use ($network, $data) {
            return User::registerByNetwork($network, $data);
        });

        event(new Registered($user));

        return $user;
    }
}
