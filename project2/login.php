

<?php
session_start();
$error = false;

require_once("settings.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($conn){  
        $query = "SELECT password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])){

                header('Location: manage.php?sort=EOInumber');
                exit();


            }else {
                $error = true;
            }
        }else{
            $error = true;
        }





    }


}


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
    <title>Login - MediZen</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Site header: logo and tagline -->
    <?php include("includes/header.inc"); ?>

    <!-- Main navigation menu -->
    <?php include("includes/nav.inc"); ?>

    <main>
        <!-- TODO: page-specific content goes here -->
        <h2>Login</h2>
        <form method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <input type="submit" value="Login">
            </p>

            <?php if ($error): ?>
                <p style="color: red;">Username or password incorrect</p>
            <?php endif; ?>

        </form>
    </main>

    <!-- Acknowledgement of Country -->
    <?php include("includes/acknowledgement.inc"); ?>

    <!-- Site footer with Jira, GitHub, and mailto email -->
    <?php include("includes/footer.inc"); ?>

    <?php
    // TODO: close the DB connection if this page used one
    if (isset($conn)) { mysqli_close($conn); }

    ?>
</body>
</html>
