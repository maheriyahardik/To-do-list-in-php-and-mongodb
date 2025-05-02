<?php
require 'db.php';
session_start();

use MongoDB\BSON\ObjectId;

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle GET request to load task data
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $task = $tasksCollection->findOne([
        '_id' => new ObjectId($taskId),
        'user_id' => $_SESSION['user_id']
    ]);

    if (!$task) {
        echo "Task not found or access denied.";
        exit();
    }
}

// Handle POST request to update task
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskId = $_POST['task_id'];
    $title = $_POST['title'];
    $steps = array_filter(explode("\n", $_POST['steps']));

    $tasksCollection->updateOne(
        [
            '_id' => new ObjectId($taskId),
            'user_id' => $_SESSION['user_id']
        ],
        [
            '$set' => [
                'title' => $title,
                'steps' => $steps
            ]
        ]
    );

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-task-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .edit-task-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        .edit-task-container input,
        .edit-task-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .edit-task-container textarea {
            resize: vertical;
            height: 150px;
        }

        .edit-task-container button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .edit-task-container button:hover {
            background-color: #0056b3;
        }

        .back-home {
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .back-home:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="edit-task-container">
    <h2>Edit Task</h2>
    <form method="post" action="update_task.php">
        <input type="hidden" name="task_id" value="<?php echo $task['_id']; ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>
        <textarea name="steps" rows="6" cols="40"><?php
            // FIX: cast BSONArray to native PHP array
            echo htmlspecialchars(implode("\n", (array)$task['steps']));
        ?></textarea><br><br>
        <button type="submit">Update Task</button>
    </form>

    <a href="dashboard.php" class="back-home">← Back to Dashboard</a>
</div>

</body>
</html>
