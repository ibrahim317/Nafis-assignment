<?php

namespace App\Http\Services;

use App\Http\Requests\TaskFilterRequest;
use App\Models\Task;
use App\Models\User;

class TaskService
{
    public static function filter(TaskFilterRequest $request)
    {
        $query = Task::query();

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('due_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        return $query->get();
    }
    public static function assignUserToTask($taskId, $userEmail)
    {
        $task = Task::findOrFail($taskId);
        $user = User::where('email', $userEmail)->first();
        $task->users()->attach($user);
        return $task;
    }
}
