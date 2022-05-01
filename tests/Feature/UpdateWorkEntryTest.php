<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateWorkEntryTest extends TestCase
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
    public function test_workentry_is_updated()
    {
        $this->putJson('/api/workentry/2', $this->data())
            ->assertStatus(200);

        $this->json('GET', "/api/workentry/2")
            ->assertStatus(200)
            ->assertJson([
                "user_id" => 2,
                "start_date" => "2021-05-01 10:00:00",
                "end_date" => "2021-05-01 18:00:00"
            ]);
    }

    public function test_workentry_start_date_greater_end_date()
    {
        $this->putJson('/api/workentry/2', $this->dataFailure())
            ->assertStatus(400);
    }

    private function data()
    {
        return [
            "user_id" => 2,
            "start_date" => "2021-05-01 10:00:00",
            "end_date" => "2021-05-01 18:00:00"
        ];
    }

    private function dataFailure()
    {
        return [
            "user_id" => 2,
            "start_date" => "2021-05-01 19:00:00",
            "end_date" => "2021-05-01 18:00:00"
        ];
    }
}
