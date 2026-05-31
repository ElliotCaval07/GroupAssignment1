<?php

    require_once("settings.php");


    $query  = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);



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
        <br>

        <aside>
            <p style="color: #1a5490; font-weight: bold;" class="centred"> 
                Those interested about applying for the following positions need to fill out the job aplication and also contact the email 
                found in the footer of the the website to provide a resume.
            </p>
        </aside>

        <?php

            while ($row = mysqli_fetch_assoc($result)) {

                $responibilities = array_filter(explode("|", $row['responsibilities']));
                $requirements = array_filter(explode("|", $row['requirements']));
            
            
        ?>

       <section class="job-pos">
                <h3 class="centred"><?php echo $row['name']; ?></h3>
                <h5><?php echo $row['id']; ?></h5>
                <p>
                    <?php echo $row['description']; ?>
                </p>
                <p>
                    <legend><h4>Resposibilities:</h4></legend> 
                    <ul>
                        <?php foreach ($responibilities as $entreeRes) {?>
                            <li><?php echo $entreeRes; ?></li>
                        <?php } ?>
                    </ul>
                </p>
                <p>
                    <legend><h4>requirments</h4></legend> 
                    <ul>
                        <?php foreach ($requirements as $entreeReq) {?>
                            <li><?php echo $entreeReq; ?></li>
                        <?php } ?>
                    </ul>
                </p>

                <br>

                <p><strong>Salary: </strong>$<?php echo $row['salary']; ?> monthly</p>

                <p><strong>Reports to: </strong><?php echo $row['reports_to']; ?></p>
        </section>

        <br>


        <?php
            }
        ?>
        <style>
            .centred {text-align: center;}

        </style>
    
    </main>

    <!-- Acknowledgement of Country -->
    <?php include("includes/acknowledgement.inc"); ?>

    <!-- Site footer with Jira, GitHub, and mailto email -->
    <?php include("includes/footer.inc"); ?>

    <?php
        if (isset($conn)) { mysqli_close($conn); }
    ?>
</body>
</html>
