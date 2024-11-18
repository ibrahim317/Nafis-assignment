<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    public function tasks(Request $request)
    {
        if (!$request->has('email'))
            return response()->json(['message' => 'Email is required'], 400);

        return TaskResource::collection(UserService::getTasksByUserEmail($request->email));
    }
}
