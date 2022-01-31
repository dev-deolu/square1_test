<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can visit the register page
     * @return void
     */
    public function test_user_can_visit_register_page()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * A user can register
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'osunsami adeolu',
            'email' => 'osunsamiadeolu@icloud.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertRedirect('/home');
        $this->isAuthenticated();
    }

    /**
     * An authenticated user cannot visit register page
     * @return void
     */
    public function test_user_cannot_visit_a_register_form_when_authenticated()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect();
    }

    
}
