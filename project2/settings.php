<?php
// settings.php
// Shared database connection used by every page that needs the DB.
// All other pages should start with: require_once("settings.php");
//
// Note: per the assessment brief, the password is left empty on the
// local XAMPP server. Do not add a password here.

$host    = "localhost";
$user    = "root";
$pwd     = "";
$sql_db  = "medizen_db";

// Try to connect. The @ silences the default warning so we can show
// our own message instead.
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// Bail out cleanly if the DB is not reachable
if (!$conn) {
    echo "<p>Sorry, we could not reach the database right now. ";
    echo "Please make sure MySQL is running in XAMPP and try again.</p>";
    exit();
}

// Use UTF-8 so special characters work properly
mysqli_set_charset($conn, "utf8mb4");
?>
