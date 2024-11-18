<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Tests\TestCase;

class TaskFilterTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        \DB::beginTransaction();
        Task::query()->delete();
    }

    protected function tearDown(): void
    {
        \DB::rollBack();
        parent::tearDown();
    }

    public function test_can_filter_tasks_by_status()
    {
        Task::factory()->count(5)->create(['status' => 'pending']);
        Task::factory()->count(3)->create(['status' => 'completed']);

        $response = $this->getJson('/api/tasks/filter?status=completed');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_can_filter_tasks_by_multiple_criteria()
    {
        // Create tasks with various statuses and due dates
        Task::factory()->count(2)->create([
            'status' => 'pending',
            'due_date' => now()->addDays(5)
        ]);

        Task::factory()->count(3)->create([
            'status' => 'completed',
            'due_date' => now()->subDays(5)
        ]);

        $response = $this->getJson('/api/tasks/filter?status=pending&start_date=' . now() . '&end_date=' . now()->addDays(5));

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}