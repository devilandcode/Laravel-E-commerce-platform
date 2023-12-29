<?php

namespace Tests\Unit\Models\User;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRequest(): void
    {
        $user = User::testRegister(
            $name = 'name',
            $email = 'email',
            $password = 'password',
            $token = 'token',
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertNotEquals($password, $user->password);

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }

    public function testVerify(): void
    {
        $user = User::testRegister('name', 'email1', 'password', 'token1');

        $user->verify();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
    }

    public function testAlreadyVerified(): void
    {
        $user = User::testRegister('name', 'email2', 'password', 'token2');

        $user->verify();

        $this->expectExceptionMessage('User is already verified');
        $user->verify();
    }
}
