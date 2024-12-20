<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Task::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $task = Task::factory()->create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => now()->addDays(1),
            'status' => 'pending',
        ]);
        // connect user to task
        $task->users()->attach($user);


    }
}
