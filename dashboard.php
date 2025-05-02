<?php
include 'header.php';
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$tasks = $tasksCollection->find(['user_id' => $_SESSION['user_id']]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Tasks</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-item {
            background-color: #f9f9f9;
            border-left: 5px solid #007bff;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 5px;
        }

        .task-title {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .step-list {
            list-style-type: disc;
            padding-left: 20px;
            color: #444;
        }

        .step {
            margin-bottom: 5px;
        }

        .task-actions {
            margin-top: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.9em;
            color: white;
            margin-right: 10px;
            display: inline-block;
        }

        .btn.logout {
            background-color: #dc3545;
        }

        .btn.add {
            background-color: #28a745;
        }

        .btn.edit {
            background-color: #007bff;
        }

        .btn.delete {
            background-color: #e03e2d;
        }
    </style>
</head>
<body>
<div class="container">


    <h2>Your Tasks</h2>

    <ul class="task-list">
    <?php foreach ($tasks as $task): ?>
        <li class="task-item">
            <div class="task-title"><strong><?= htmlspecialchars($task['title']) ?></strong></div>
            <?php if (!empty($task['steps'])): ?>
                <ul class="step-list">
                <?php foreach ($task['steps'] as $step): ?>
                    <li class="step"><?= htmlspecialchars($step) ?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="task-actions">
                <a class="btn edit" href="update_task.php?id=<?= $task['_id'] ?>">Edit</a>
                <a class="btn delete" href="delete_task.php?id=<?= $task['_id'] ?>">Delete</a>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
</body>
</html>

<?php include 'footer.php'; ?>
