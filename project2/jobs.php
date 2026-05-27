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
        <br>

        <aside>
            <p style="color: #1a5490; font-weight: bold;" class="centred"> 
                Those interested about applying for the following positions need to fill out the job aplication and also contact the email 
                found in the footer of the the website to provide a resume.
            </p>
        </aside>


        <section class="job-pos">
            <h3 class="centred">Digital wellness consultant</h3>
            <h5>H5C7B</h5>
            <p>
                As the digital wellness consultant at mediZen you will act as the face of the company. This position will 
                consist of supporting our clients with all of there health and wellness needs in a professional manner that 
                builds trust in our brand. compassion and interest in helping the wellbeing of otheres is of the highest priority 
                as it is important in assuring the integrity of out services.
            </p>
            <p>
                <legend><h4>Resposibilities:</h4></legend> 
                <ul>
                    <li>Provide virtual consultations via video, chat, or phone</li>
                    <li>Develop personalised wellness plans and goals</li>
                    <li>Monitor client progress using digital tracking tools</li>
                    <li>Ensure compliance with privacy and healthcare regulations</li>
                </ul>
            </p>
            <p>
                <legend><h4>requirments</h4></legend> 
                <ul>
                    <li>Strong communication and interpersonal skills</li>
                    <li>Empathy and active listening</li>
                    <li>Understanding of health and wellness principles</li>
                </ul>
            </p>

            <br>

            <p><strong>Salary: </strong>9,000 monthly</p>

            <p><strong>Reports to: </strong>Wellness Program Manager</p>
            
        </section>
        <br>

        <section class="job-pos">
            <h3 class="centred">Client data entry</h3>
            <h5>JB235</h5>
            <p>
                A Client Data Entry Officer is responsible for accurately inputting, updating, and maintaining client 
                information within digital systems. This role ensures that all records are complete, secure, and accessible 
                to support efficient service delivery.
            </p>
            <p>
                <legend><h4>Resposibilities:</h4></legend> 
                <ul>
                    <li>Enter client information into databases and digital systems</li>
                    <li>Update and maintain accurate client records</li>
                    <li>Organise and manage digital files and documents</li>
                    <li>Identify and correct data errors</li>
                </ul>
            </p>
            <p>
                <legend><h4>requirments</h4></legend> 
                <ul>
                    <li>High attention to detail</li>
                    <li>Fast and accurate typing skills</li>
                    <li>Basic computer and data management skills</li>
                </ul>
            </p>

            <br>

            <p><strong>Salary: </strong>8,000 monthly</p>

            <p><strong>Reports to: </strong>Client data Manager</p>
            
        </section>

        <br>
        <style>
            .centred {text-align: center;}

        </style>
    
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
