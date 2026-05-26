<?php
// apply.php
// Placeholder page that tests the database connection works.
// Following the Week 9 and Week 10 lecture patterns.
//
// TODO Kevin: replace this whole page with the real EOI form for Task 4.
// This is just a small test form to make sure the DB is connected
// and we can save and read data.

require_once("settings.php");

// Sanitise function from Week 7 PHP2 lecture
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create the test table if it does not exist yet
$sql = "CREATE TABLE IF NOT EXISTS test_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

// Handle the form submission
$submit_status = "";
if (isset($_POST['name'])) {
    // Clean the inputs 
    $name = sanitise_input($_POST['name']);
    $message = sanitise_input($_POST['message']);

    // Escape for SQL to block SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $message = mysqli_real_escape_string($conn, $message);

    // Save to the database (Week 10 INSERT pattern)
    $insert_sql = "INSERT INTO test_messages (name, message) VALUES ('$name', '$message')";
    $result = mysqli_query($conn, $insert_sql);

    if ($result) {
        $submit_status = "Saved! Your test entry has been added to the database.";
    } else {
        $submit_status = "Save failed: " . mysqli_error($conn);
    }
}

// Get the latest 5 test entries (Week 9 SELECT pattern)
$select_sql = "SELECT * FROM test_messages ORDER BY id DESC LIMIT 5";
$recent_result = mysqli_query($conn, $select_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediZen apply page (DB test placeholder)">
    <meta name="keywords" content="MediZen, apply, EOI, application">
    <meta name="author" content="J.E.K Group - MediZen">
    <title>Apply - MediZen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include("includes/header.inc"); ?>
    <?php include("includes/nav.inc"); ?>

    <main>
        <h2>Apply (DB Test Placeholder)</h2>
        <p>
            <strong>TODO Kevin:</strong> replace this whole page with the
            real EOI form for Task 4. The form below is just here to prove
            the database connection is working end-to-end.
        </p>

        <hr>

        <h3>Simple DB Connection Test</h3>
        <p>
            Fill in the form and click Save. The entry will be stored in
            the test_messages table and shown below.
        </p>

        <?php if ($submit_status != "") { ?>
            <p class="status-message"><?php echo $submit_status; ?></p>
        <?php } ?>

        <form method="post" action="apply.php" novalidate>
            <p>
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" maxlength="50">
            </p>
            <p>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="3" maxlength="200"></textarea>
            </p>
            <p>
                <input type="submit" value="Save Test Entry">
            </p>
        </form>

        <hr>

        <h3>Recent Test Entries</h3>
        <?php
        // Display the rows using the Week 9 while loop pattern
        if (mysqli_num_rows($recent_result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($recent_result)) {
                echo "<li>";
                echo "<strong>" . $row['name'] . "</strong>";
                if ($row['message'] != "") {
                    echo ": " . $row['message'];
                }
                echo " <small>(" . $row['created_at'] . ")</small>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No entries yet. Submit the form above to add one.</p>";
        }

        // Close the database connection (Week 9 pattern)
        mysqli_close($conn);
        ?>
    </main>

    <?php include("includes/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>
</html>
