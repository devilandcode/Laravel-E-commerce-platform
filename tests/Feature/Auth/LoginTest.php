<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group Login
     * @return void
     */
    public function testLoginPage(): void
    {
        $response = $this->get('/login');

        $response
            ->assertStatus(200)
            ->assertSee('Login');
    }

    /**
     * @group Login
     * @return void
     */
    public function testLoginErrors(): void
    {
        $response = $this->post('/login', [
           'email' => '',
           'password' => ''
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }

    /**
     * @group Error
     * @return void
     */
    public function testWait(): void
    {
        $user = User::factory()->create(['role' => User::STATUS_WAIT]);


        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('error', 'You need to confirm your account. Please check your email.');
    }

    /**
     * @group Auth
     * @return void
     */
    public function testAuthorize(): void
    {
        $user = User::factory()->create(['role' => User::STATUS_ACTIVE]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/account');

        $this->assertAuthenticated();

    }
}
