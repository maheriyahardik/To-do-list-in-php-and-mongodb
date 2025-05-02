<?php
require 'vendor/autoload.php'; // Ensure you have the MongoDB PHP library installed

// Create a new MongoDB client instance
$client = new MongoDB\Client("mongodb://localhost:27017");

echo "Connection successful<br>";

// Select the database
$db = $client->selectDatabase("keyur");

echo "Database selected: " . $db->getDatabaseName();
?>
