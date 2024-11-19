<?php

namespace App\Http\Services;

use App\Http\Requests\FilterTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskReminderNotification;

class TaskService
{
    public static function createTask($request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->save();
        return $task;
    }
    public static function updateTask($request, $task)
    {
        $task->title = $request->title ?? $task->title;
        $task->description = $request->description ?? $task->description;
        $task->due_date = $request->due_date ?? $task->due_date;
        $task->status = $request->status ?? $task->status;
        $task->save();
        return $task;
    }
    public static function filter(FilterTaskRequest $request)
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
    public static function assignUserToTask($task, $userEmail)
    {
        $users = User::whereIn('email', $userEmail)->get();
        foreach ($users as $user) {
            if (!$task->users()->where('user_id', $user->id)->exists()) {
                $task->users()->attach($user);
                if ($task->due_date->diffInHours(now()) <= 24) {
                    $user->notify(new TaskReminderNotification($task));
                }
            }
        }
        return $task;
    }
}
