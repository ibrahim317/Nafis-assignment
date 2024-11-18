<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\TaskResource;

class UserController
{
    public function tasks(string $id)
    {
        $user = User::findOrFail($id);
        return TaskResource::collection($user->tasks);
    }
}
