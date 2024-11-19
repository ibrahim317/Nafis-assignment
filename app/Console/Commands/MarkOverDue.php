<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
class MarkOverDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark overdue tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting overdue task process...');
        $tasks = Task::where('due_date', '<', now())->get();
        $this->info("Found {$tasks->count()} tasks to mark as overdue.");
        foreach ($tasks as $task) {
            $task->overdue = true;
            $task->save();
        }
        $this->info('Overdue task process completed.');
    }
}
