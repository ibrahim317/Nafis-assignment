<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class UnNotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'un-notify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('reminder_sent', true)->get();
        foreach ($tasks as $task) {
            $task->reminder_sent = false;
            $task->save();
        }
    }
}
