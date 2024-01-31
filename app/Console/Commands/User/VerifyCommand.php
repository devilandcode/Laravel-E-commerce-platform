<?php

namespace App\Console\Commands\User;

use App\Models\User\User;
use App\Services\Auth\RegisterService;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    protected $signature = 'user:verify {email}';
    protected $description = 'Verify User via email';

    public function __construct(private RegisterService $service)
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $email = $this->argument('email');

        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with this email - ' . $email);
            return false;
        }

        try {
            $this->service->verify($user->id);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('success, User - ' . $this->argument('email') . ' is Verified');
        return true;
    }
}
