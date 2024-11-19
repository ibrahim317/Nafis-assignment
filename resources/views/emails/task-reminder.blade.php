<!DOCTYPE html>
<html>

<head>
    <title>Task Reminder</title>
</head>

<body>
    <h1>Task Reminder</h1>
    <p>Hello, {{ $user->name }}</p>
    <p>This is a reminder that the following task is due within 24 hours:</p>

    <h2>{{ $task->title }}</h2>
    <p><strong>Due Date:</strong> {{ $task->due_date->format('F j, Y g:i A') }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>

    <p>Please ensure this task is completed before the deadline.</p>

    <p>Thank you!</p>
</body>

</html>