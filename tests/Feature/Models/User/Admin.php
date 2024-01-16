<?php

namespace Tests\Feature\Models\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class Admin extends TestCase
{
    use DatabaseTransactions;

    public function testCreateUser(): void
    {
        $user = User::new(
            $name = 'name',
            $email = 'email'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertTrue($user->isActive());
        self::assertFalse($user->isAdmin());
    }
}
