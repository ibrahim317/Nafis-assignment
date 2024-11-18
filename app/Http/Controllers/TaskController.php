<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Http\Requests\AsssignUserToTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Http\Resources\UserResource;
class TaskController
{
    public function index()
    {
        return Task::all();
    }


    public function store(TaskRequest $request)
    {
        return Task::create($request->all());
    }


    public function show(string $id)
    {
        return Task::findOrFail($id);
    }


    public function update(TaskRequest $request, string $id)
    {
        return Task::findOrFail($id)->update($request->all());
    }

    public function destroy(string $id)
    {
        return Task::findOrFail($id)->delete();
    }
    public function assign(AsssignUserToTaskRequest $request)
    {
        $task = TaskService::assignUserToTask($request->task_id, $request->user_email);
        return TaskResource::make($task->load('users'));
    }
    public function filter(TaskFilterRequest $request)
    {
        $tasks = TaskService::filter($request);
        return TaskResource::collection($tasks);
    }

}
