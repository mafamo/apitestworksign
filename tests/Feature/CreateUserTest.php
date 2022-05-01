<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_new_user_is_created()
    {
        $this->postJson('/api/user/create', $this->data())
            ->assertStatus(201);

        $this->assertCount(1, User::all());

        $user = User::first();

        $this->json('GET', "/api/user/$user->id")
            ->assertStatus(200)
            ->assertJson([
                'name' => "NewUser Test",
                'email' => "newuser@test.com"
            ]);
    }

    private function data()
    {
        return [
            'name' => "NewUser Test",
            'email' => "newuser@test.com"
        ];
    }
}
