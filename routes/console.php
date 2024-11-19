<?php

use App\Console\Commands\NotifyUsers;
use App\Console\Commands\MarkOverDue;
use Illuminate\Support\Facades\Schedule;

Schedule::command(NotifyUsers::class)->everyMinute();
Schedule::command(MarkOverDue::class)->everyMinute();
