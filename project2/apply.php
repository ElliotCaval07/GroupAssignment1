<?php
// apply.php
// PLACEHOLDER page - tests that the DB connection works end-to-end.
// Owner: Kevin (Task 4 - full implementation will replace this)
//
// This file has a tiny 2-field form that saves to a "test_messages"
// table. It is just a temporary DB connection test for the foundation
// PR. Kevin will replace it with the real EOI form once Task 4 starts.

require_once("settings.php");

// Create the test table if it does not exist yet (safe to run every time)
$create_test_sql = "CREATE TABLE IF NOT EXISTS test_messages (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    message     VARCHAR(200),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $create_test_sql);

// Handle the form submission (only when the form was POSTed)
$submit_status = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    // Basic sanitise - real validation goes in process_eoi.php later
    $name    = htmlspecialchars(trim($_POST['name'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Prepared statement to block SQL injection
    $stmt = mysqli_prepare($conn,
        "INSERT INTO test_messages (name, message) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $name, $message);

    if (mysqli_stmt_execute($stmt)) {
        $submit_status = "Saved! Your test entry has been added to the database.";
    } else {
        $submit_status = "Save failed: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

// Pull the 5 most recent test entries so we can show them on the page
$recent_query  = "SELECT name, message, created_at
                  FROM test_messages
                  ORDER BY id DESC
                  LIMIT 5";
$recent_result = mysqli_query($conn, $recent_query);
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
            the <code>test_messages</code> table and shown below.
        </p>

        <?php if ($submit_status !== ""): ?>
            <p class="status-message"><?php echo htmlspecialchars($submit_status); ?></p>
        <?php endif; ?>

        <form method="post" action="apply.php" novalidate class="db-test-form">
            <p>
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" maxlength="50">
                <small>Up to 50 characters.</small>
            </p>
            <p>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="3" maxlength="200"></textarea>
                <small>Optional. Up to 200 characters.</small>
            </p>
            <p>
                <input type="submit" value="Save Test Entry">
            </p>
        </form>

        <hr>

        <h3>Recent Test Entries</h3>
        <?php if ($recent_result && mysqli_num_rows($recent_result) > 0): ?>
            <ul class="test-entries">
                <?php while ($row = mysqli_fetch_assoc($recent_result)): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                        <?php if (!empty($row['message'])): ?>
                            : <?php echo htmlspecialchars($row['message']); ?>
                        <?php endif; ?>
                        <small>(<?php echo htmlspecialchars($row['created_at']); ?>)</small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No entries yet. Submit the form above to add one.</p>
        <?php endif; ?>

        <?php
        // Tidy up
        if ($recent_result) mysqli_free_result($recent_result);
        mysqli_close($conn);
        ?>
    </main>

    <?php include("includes/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>
</html>
