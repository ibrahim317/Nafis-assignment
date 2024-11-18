<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/tasks/filter', [TaskController::class, 'filter']);
Route::get('/users/{id}/tasks', [UserController::class, 'tasks']);

Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

Route::post('/tasks/{id}/assign', [TaskController::class, 'assign']);

