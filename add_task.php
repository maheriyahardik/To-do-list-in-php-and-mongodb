<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $steps = array_filter(explode("\n", $_POST['steps'])); // each line = step

    $tasksCollection->insertOne([
        'user_id' => $_SESSION['user_id'],
        'title' => $title,
        'steps' => $steps
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task - To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .add-task-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        .add-task-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        .add-task-container input, .add-task-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .add-task-container textarea {
            height: 150px;
            resize: vertical;
        }

        .add-task-container button {
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

        .add-task-container button:hover {
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

<div class="add-task-container">
    <h2>Add Task</h2>

    <form method="post">
        <input name="title" placeholder="Task title" required>
        <textarea name="steps" placeholder="One step per line" required></textarea>
        <button type="submit">Add Task</button>
    </form>

    <a href="dashboard.php" class="back-home">← Back to Dashboard</a>
</div>

</body>
</html>
