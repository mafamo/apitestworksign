<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetWorkEntriesByUserIdTest extends TestCase
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
    public function test_get_work_entries_by_user_id()
    {
        $this->getJson('/api/workentry/user/1')
            ->assertStatus(200)
            ->assertJson(json_decode($this->data(), true));
    }

    private function data()
    {
        return '[
            {
                "id": 1,
                "user_id": 1,
                "start_date": "2022-05-01 10:00:00",
                "end_date": "2022-05-01 18:00:00",
                "created_at": "2022-05-01 09:00:00",
                "updated_at": "2022-05-01 09:00:00",
                "deleted_at": null
            },
            {
                "id": 3,
                "user_id": 1,
                "start_date": "2022-05-02 10:00:00",
                "end_date": "2022-05-02 18:00:00",
                "created_at": "2022-05-02 09:00:00",
                "updated_at": "2022-05-02 09:00:00",
                "deleted_at": null
            },
            {
                "id": 4,
                "user_id": 1,
                "start_date": "2022-05-03 10:00:00",
                "end_date": null,
                "created_at": "2022-05-03 09:00:00",
                "updated_at": "2022-05-03 09:00:00",
                "deleted_at": null
            }
        ]';
    }
}
