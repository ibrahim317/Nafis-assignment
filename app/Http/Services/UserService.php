<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public static function getTasksByUserEmail($email)
    {
        return User::where('email', $email)->first()->tasks;
    }
}
