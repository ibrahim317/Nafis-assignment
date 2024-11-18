<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{



    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        \DB::beginTransaction();
        Task::query()->delete();
        $this->task = Task::factory()->create();
    }
    protected function tearDown(): void
    {
        \DB::rollBack();
        parent::tearDown();
    }
    public function test_can_get_all_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(4); // 3 + 1 from setUp
    }

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'due_date' => '2024-12-31 00:00:00',
            'status' => 'pending'
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment($taskData);
    }

    public function test_can_get_single_task()
    {
        $response = $this->getJson("/api/tasks/{$this->task->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $this->task->id,
                'title' => $this->task->title
            ]);
    }

    public function test_can_update_task()
    {
        $updatedData = [
            'title' => 'Updated Task',
            'description' => 'Updated Description',
            'status' => 'in_progress'
        ];

        $response = $this->putJson("/api/tasks/{$this->task->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $this->task->id,
            'title' => 'Updated Task'
        ]);
    }

    public function test_can_delete_task()
    {
        $response = $this->deleteJson("/api/tasks/{$this->task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', [
            'id' => $this->task->id
        ]);
    }
}