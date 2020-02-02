<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_user_can_login()
    {
        $user = User::create([
            'email' => uniqid() . '@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /** @test */
    public function a_user_cannot_login_with_incorrect_credentials()
    {
        $user = User::create([
            'email' => uniqid() . '@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'testtesttest',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->post('/register', [
            'email' => uniqid() . '@gmail.com',
            'password' => 'testpassword',
            'password_confirmation' => 'testpassword'
        ]);

        $response->assertStatus(200);
    }
}
