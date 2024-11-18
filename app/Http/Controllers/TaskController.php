<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Http\Requests\AssignUserToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;

class TaskController
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }


    public function store(StoreTaskRequest $request)
    {

        $task = TaskService::createTask($request);
        return TaskResource::make($task);
    }


    public function show(Task $task)
    {
        return TaskResource::make($task);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task = TaskService::updateTask($request, $task);
        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
    public function assign(AssignUserToTaskRequest $request, Task $task)
    {
        $task = TaskService::assignUserToTask($task, $request->users_email);
        return TaskResource::make($task);
    }
    public function filter(FilterTaskRequest $request)
    {
        $tasks = TaskService::filter($request);
        return TaskResource::collection($tasks);
    }

}
