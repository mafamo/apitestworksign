<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
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
    public function test_user_is_delete()
    {
        $this->deleteJson('/api/user/1')
            ->assertStatus(200);

        $this->json('GET', "/api/user/1")
            ->assertStatus(404);
    }
}
