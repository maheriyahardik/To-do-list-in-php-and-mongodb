<?php
require 'db.php';
session_start();

$id = new MongoDB\BSON\ObjectId($_GET['id']);
$tasksCollection->deleteOne(['_id' => $id]);
header("Location: dashboard.php");
exit();
?>
