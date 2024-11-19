<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class UserTaskTest extends TestCase
{

    private User $user;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        \DB::beginTransaction();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }

    protected function tearDown(): void
    {
        \DB::rollBack();
        parent::tearDown();
    }

    public function test_can_assign_user_to_task()
    {
        $response = $this->postJson("/api/tasks/{$this->task->id}/assign", [
            'users_email' => [$this->user->email]
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $this->task->id);
    }

    public function test_can_get_user_tasks()
    {
        // Create tasks and assign them to the user
        $tasks = Task::factory()->count(3)->create();
        $this->user->tasks()->attach($tasks->pluck('id'));

        $response = $this->getJson("/api/users/tasks?email={$this->user->email}");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_cannot_assign_task_to_nonexistent_user()
    {
        $response = $this->postJson("/api/tasks/{$this->task->id}/assign", [
            'users_email' => ['nonexistent@example.com']
        ]);

        $response->assertStatus(422);
    }
}