<?php

namespace App\Console\Commands\User;

use App\Models\User\User;
use Illuminate\Console\Command;

class RoleCommand extends Command
{

    protected $signature = 'user:role {email} {role}';

    protected $description = 'Change User Role';


    public function handle(): bool
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);
            return false;
        }

        try {
            $user->changeRole($role);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('Role is successfully changed');
        return true;
    }
}
