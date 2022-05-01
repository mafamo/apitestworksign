<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteWorkEntryTest extends TestCase
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
    public function test_workentry_is_deleted()
    {
        $this->deleteJson('/api/workentry/2')
            ->assertStatus(200);

        $this->json('GET', "/api/workentry/2")
            ->assertStatus(404);
    }
}
