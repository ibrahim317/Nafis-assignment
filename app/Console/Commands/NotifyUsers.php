<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskReminderNotification;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about tasks that are due within the next 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting task notification process...');

        $tasks = Task::shouldNotify()->get();

        $this->info("Found {$tasks->count()} tasks to notify about.");

        foreach ($tasks as $task) {
            try {
                Notification::send(
                    $task->users,
                    new TaskReminderNotification($task)
                );
                $task->reminder_sent = true;
                $task->save();

                $this->info("Sent reminder for task: {$task->title}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for task {$task->title}: {$e->getMessage()}");
                continue;
            }
        }

        $this->info('Task notification process completed.');
    }
}
