<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAllUsersTest extends TestCase
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
    public function test_get_all_users()
    {
        $this->getJson('/api/user/all')
            ->assertStatus(200)
            ->assertJson(json_decode($this->data(), true));
    }

    private function data()
    {
        return '[
            {
                "id": 1,
                "name": "Test 1",
                "email": "test1@test.com",
                "created_at": "2022-05-01 09:00:00",
                "update_at": "2022-05-01 09:00:00",
                "deleted_at": null
            },
            {
                "id": 2,
                "name": "Test 2",
                "email": "test2@test.com",
                "created_at": "2022-05-01 10:00:00",
                "update_at": "2022-05-01 10:00:00",
                "deleted_at": null
            }
        ]';
    }
}
