<?php

namespace Tests\Feature\Models\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Admin extends TestCase
{

    public function testCreateUser(): void
    {
        $user = User::new(
            $name = 'name',
            $email = 'email@gmail.com'
        );
        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertTrue($user->isActive());
    }
}
