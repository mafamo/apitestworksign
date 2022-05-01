<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\WorkEntry;

class CreateWorkEntryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed UserSeeder');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_new_workentry_is_created()
    {
        $this->postJson('/api/workentry/create', $this->data())
            ->assertStatus(201);

        $this->assertCount(1, WorkEntry::all());

        $workEntry = WorkEntry::first();

        $this->json('GET', "/api/workentry/$workEntry->id")
            ->assertStatus(200)
            ->assertJson([
                "user_id" => 2,
                "start_date" => "2022-05-01 10:00:00"
            ]);
    }

    private function data()
    {
        return [
            "user_id" => 2,
            "start_date" => "2022-05-01 10:00:00"
        ];
    }
}
