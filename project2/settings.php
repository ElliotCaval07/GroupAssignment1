<?php
// settings.php
// Database connection details for our MediZen project.
// Following the Week 9 lecture pattern.
// We use this file in every page that needs the database.

$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "medizen_db";

// Try to connect to the database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// If the connection failed, stop the page and show the error
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
