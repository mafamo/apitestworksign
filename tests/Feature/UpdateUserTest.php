<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_is_updated()
    {
        $this->putJson('/api/user/1', $this->data())
            ->assertStatus(200);

        $this->json('GET', "/api/user/1")
            ->assertStatus(200)
            ->assertJson([
                'name' => "UpdateUser Test",
                'email' => "updateuser@test.com"
            ]);
    }

    private function data()
    {
        return [
            'name' => "UpdateUser Test",
            'email' => "updateuser@test.com"
        ];
    }
}
