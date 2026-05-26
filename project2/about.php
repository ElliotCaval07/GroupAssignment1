<?php
// _page_skeleton.php
// COPY THIS FILE when creating a new page. Rename it (e.g. about.php),
// then fill in the TODO markers below.
//
// The underscore prefix means "template only, not a real page" - leave
// it in the repo as a reference. Do not link to it from the nav.
//
// Why we keep this structure consistent across every page:
//   - Viewport meta - mobile responsive (Part 1 feedback)
//   - Description, keywords, author meta - SEO and accessibility (Part 1 feedback)
//   - Single shared style.css link (Part 1 feedback - one stylesheet)
//   - Shared includes - the rubric's 10-pt criterion needs every page
//     to use the same modular includes

// TODO: uncomment if this page reads or writes the database
// require_once("settings.php");

// TODO: run any DB queries this page needs (delete if not needed)
// $query  = "SELECT * FROM some_table ORDER BY some_column";
// $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Viewport for mobile responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TODO: update these three meta tags for this specific page -->
    <meta name="description" content="TODO short description of this page">
    <meta name="keywords" content="TODO, MediZen, comma, separated, keywords">
    <meta name="author" content="J.E.K Group - MediZen">

    <!-- TODO: update the page title -->
    <title>TODO Page Title - MediZen</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Site header: logo and tagline -->
    <?php include("includes/header.inc"); ?>

    <!-- Main navigation menu -->
    <?php include("includes/nav.inc"); ?>

    <main>
        <!-- TODO: page-specific content goes here -->
        <h2>TODO Page Heading: Elliot Task</h2>
        <p>Replace this with the real content for this page.</p>

        <!--
            TODO: Part 1 feedback asks for one embedded <style> block
            AND one inline style="" example per page. Example:

            <style>
                .my-page-class { background: #eef; }
            </style>

            <p style="color: navy;">This paragraph uses inline style.</p>
        -->
    </main>

    <!-- Acknowledgement of Country -->
    <?php include("includes/acknowledgement.inc"); ?>

    <!-- Site footer with Jira, GitHub, and mailto email -->
    <?php include("includes/footer.inc"); ?>

    <?php
    // TODO: close the DB connection if this page used one
    // if (isset($conn)) { mysqli_close($conn); }
    ?>
</body>
</html>
