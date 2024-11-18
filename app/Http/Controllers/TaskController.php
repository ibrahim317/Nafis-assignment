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
        return Task::all();
    }


    public function store(StoreTaskRequest $request)
    {

        $task = TaskService::createTask($request);
        return TaskResource::make($task);
    }


    public function show(string $id)
    {
        return Task::findOrFail($id);
    }


    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = TaskService::updateTask($request, $id);
        return Task::findOrFail($id)->update($request->all());
    }

    public function destroy(string $id)
    {
        return Task::findOrFail($id)->delete();
    }
    public function assign(AssignUserToTaskRequest $request, string $taskId)
    {
        try {
            $task = TaskService::assignUserToTask($taskId, $request->users_email);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], );
        }
        return TaskResource::make($task);

    }
    public function filter(FilterTaskRequest $request)
    {
        $tasks = TaskService::filter($request);
        return TaskResource::collection($tasks);
    }

}
