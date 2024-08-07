<?php
$db_servername = "localhost"; // Replace with your MySQL server hostname or IP address
$db_username = "root"; // Replace with your MySQL username
$db_password = ""; // Replace with your MySQL password
$db_database = "sp_weblog"; // Replace with the name of your MySQL database
$backupPath = "http://localhost/salar/admin/backups/";

// Create a connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>