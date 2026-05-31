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
       

        <!-- TODO Elliot: copy in the Part 1 home page content here. -->
        <!-- TODO Elliot: add a company-relevant image (Part 1 feedback). -->
        <!-- TODO Elliot: reduce clutter and improve visual layout (Part 1 feedback). -->
        <!-- TODO Elliot: add one embedded <style> block + one inline style (Part 1 feedback). -->
           
   
    
</head>

<body> 
<header>
   
    <p>Welcome to Medizen, this page will help direct you to the relevant page you are looking for</p>

</header>

<table>
    
    
    <thead>

        <tr>
            <th colspan="2">Webpage Contents</th>
        </tr>
      <tr>
        <th>Page Name</th>
        <th>Contents</th>
      </tr>
    </thead>
    
    <tbody>
      <tr>
        <td><a href="index.php">Home Page</a></td>
        <td>Overview of Medizen</td>
        
      </tr>
      <tr>
        <td><a href="about.php">About Page</a></td>
        <td>Learn about how 3 businessmen founded Medizen</td>
        
      </tr>

      <tr>
        <td><a href="jobs.php">Jobs Page</a></td>
        <td>What a job at Medizen looks like</td>
      </tr>

      <tr>
        <td><a href="apply.php">Apply Page</a></td>
        <td>Where to apply to be a part of our expert team</td>
      </tr>

      <tr>
        <td><a href="manage.php">Manage Page</a></td>
        <td>For employees to access our database</td>
    </tr>
    </tbody>

    
</table>

<fieldset>
    <legend><em>Our Mission</em></legend>
    <p>
        Medizen is a health and digital wellness company dedicated to improving access to reliable, user-friendly healthcare solutions across Botswana. Founded by three entrepreneurs with backgrounds in healthcare and technology and business, Medizen combines practical medical insight with innovative digital tools to support individuals and communities. Its platform offers features such as medication reminders, basic health tracking, telehealth consultations, and secure digital health records, all designed to function even in low-connectivity environments. Medizen focuses on simplicity, accessibility, and local relevance, ensuring its services are usable on a wide range of devices and adaptable to different lifestyles. By partnering with clinics and healthcare providers, the company helps streamline patient care while empowering individuals to take control of their health. Medizen’s mission is to bridge the gap between traditional healthcare systems and modern technology, creating a healthier, more connected future for communities across the region.
    </p>
</fieldset>

  <p align="center">
<img src="images/medizenteam.jpg" alt="Medizen team image" id="teamPic">
</p>

    </main>

    <?php include("includes/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>
</html>
