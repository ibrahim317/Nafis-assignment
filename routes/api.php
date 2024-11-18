<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'tasks'], function () {
    // filter tasks by either status or due date
    Route::get('/filter', [TaskController::class, 'filter']);
    // create task
    Route::post('/', [TaskController::class, 'store']);
    // get all tasks
    Route::get('/', [TaskController::class, 'index']);
    // get task by id
    Route::get('/{task}', [TaskController::class, 'show']);
    // update task
    Route::put('/{task}', [TaskController::class, 'update']);
    // delete task
    Route::delete('/{task}', [TaskController::class, 'destroy']);
    // assign user to task
    Route::post('/{task}/assign', [TaskController::class, 'assign']);
});

// get tasks assigned to a user by email
Route::get('/users/tasks', [UserController::class, 'tasks']);
