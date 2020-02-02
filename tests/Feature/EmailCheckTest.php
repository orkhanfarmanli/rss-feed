<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailCheckTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_email_doesnt_exists_in_database()
    {
        $email = uniqid() . '@gmail.com';

        $response = $this->post('/check-email', [
            'email' => $email
        ]);

        $response->assertStatus(404);
    }

    /** @test */
    public function an_email_exists_in_database()
    {
        $user = User::create([
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('testuser')
        ]);

        $response = $this->post('/check-email', [
            'email' => $user->email
        ]);

        $response->assertStatus(200);
    }
}
