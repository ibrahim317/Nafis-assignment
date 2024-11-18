<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::post('/tasks', [TaskController::class, 'create']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);

Route::get('/tasks/filter', [TaskController::class, 'filter']);
Route::get('/users/{id}/tasks', [TaskController::class, 'userTasks']);
Route::post('/tasks/assign', [TaskController::class, 'assign']);
