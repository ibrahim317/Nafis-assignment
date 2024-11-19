<?php

use App\Console\Commands\NotifyUsers;
use App\Console\Commands\MarkOverDue;
use Illuminate\Support\Facades\Schedule;

Schedule::command(NotifyUsers::class)->hourly();
Schedule::command(MarkOverDue::class)->hourly();
