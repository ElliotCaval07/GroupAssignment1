<?php
// index.php
// Home page placeholder so the project loads from the root URL.
// Owner: Elliot (Task 1)
//
// This file is intentionally minimal - just enough for testing that the
// shared includes work. Elliot will replace the main content with the
// real Part 1 home page content (description, contents table, etc.) and
// also address the Part 1 feedback items (logo placement, company image,
// reduce clutter, mailto, etc.).
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediZen home page - healthcare recruitment platform">
    <meta name="keywords" content="MediZen, healthcare, recruitment, home, employment">
    <meta name="author" content="J.E.K Group - MediZen">
    <title>Home - MediZen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include("includes/header.inc"); ?>
    <?php include("includes/nav.inc"); ?>

    <main>
        <h2>Welcome to MediZen</h2>
        <p>
            This is a placeholder home page. Elliot will replace this section
            with the full Part 1 home content and address the visual feedback
            from Part 1.
        </p>

        <!-- TODO Elliot: copy in the Part 1 home page content here. -->
        <!-- TODO Elliot: add a company-relevant image (Part 1 feedback). -->
        <!-- TODO Elliot: reduce clutter and improve visual layout (Part 1 feedback). -->
        <!-- TODO Elliot: add one embedded <style> block + one inline style (Part 1 feedback). -->
    </main>

    <?php include("includes/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>
</html>
