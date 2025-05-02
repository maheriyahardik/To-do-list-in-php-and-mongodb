<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List - Header</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #007bff;
            padding: 15px 20px;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #cce5ff;
        }

        hr {
            margin: 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        .content {
            padding: 30px;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_task.php">Add Task</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<hr>

<div class="content">
    <!-- Page content goes here -->
    <h1>Welcome to Your To-Do List</h1>
    
</div>

</body>
</html>
