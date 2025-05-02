<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to ToDo List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container center">
        <h1>Welcome to Your To-Do List</h1>
        <div class="auth-links">
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Register</a>
        </div>
    </div>
</body>
</html>
