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
    <title>About Us - MediZen</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Site header: logo and tagline -->
    <?php include("includes/header.inc"); ?>

    <!-- Main navigation menu -->
    <?php include("includes/nav.inc"); ?>

    <main>
        <!-- TODO: page-specific content goes here -->
        <h2>bout us at Medizen</h2>
        <p>Replace this with the real content for this page.</p>

        <!--
            TODO: Part 1 feedback asks for one embedded <style> block
            AND one inline style="" example per page. Example:

            <style>
                .my-page-class { background: #eef; }
            </style>

            <p style="color: navy;">This paragraph uses inline style.</p>
        -->
            <style>
    /* Figure border */
    figure {
      border: 2px solid #1a5490;
      padding: 10px;
      max-width: 400px;
    }

    /* Make image fit inside the figure */
    figure img {
      width: 100%;
    }

    /* Student ID styling */
    .student-id {
      background-color: #e8f4f8;
      padding: 2px 6px;
    }

    /* Table with hex colour and hover */
    table {
      border: 1px solid #cccccc;
      margin: 0;
    }

    table th {
      background-color: #1a5490;
      color: #ffffff;
      padding: 8px;
    }

    table td {
      padding: 8px;
    }

    table tr:hover {
      background-color: #e8f4f8;
    }

    /* Section styling for consistancy */
    section {
      border: 2px solid black;
      border-radius: 10px;
      padding: 10px;
      margin: 20px 0;
      width: 50%;
    }

    /* Member list styling */
    .member-list dt {
      font-weight: bold;
      margin-top: 10px;
    }
  </style>

</head>

<body>

  <!-- Group and class details using nested list -->
  <section>
    <h2 style="text-align: left; color: black; font-size: 1.2em;">Group Details</h2>
    <ul>
      <li>Group Name
        <ul>
          <li>J.E.K</li>
        </ul>
      </li>
      <li>Class Details
        <ul>
          <li>Wednesday</li>
          <li>4:30pm - 6:30pm</li>
          <li>Tutor: Rahul</li>
        </ul>
      </li>
    </ul>
  </section>

  <!-- Member contributions and quotes using definition list -->
  <section>
    <h2 style="text-align: left; color: black; font-size: 1.2em;">Member Contributions</h2>
    <dl class="member-list">

      <dt>
        Elliot Caval
        <span class="student-id">106513795</span>
      </dt>
      <dd>
        <p><strong>Contribution:</strong> Developed index.html, about.html, set up the project structure, and created
          the
          shared
          header and footer.</p>
        <p><strong>Quote (Indonesian):</strong> <q lang="id">Nama saya Elliot</q></p>
        <p><strong>English:</strong> <q>My name is Elliot</q></p>
      </dd>

      <dt>
        Jaxon Del Mastro
        <span class="student-id">106523532</span>
      </dt>
      <dd>
        <p><strong>Contribution:</strong> Developed apply.html and jobs.html.</p>
        <p><strong>Quote (German):</strong> <q lang="de">Guten Morgen</q></p>
        <p><strong>English:</strong> <q>Good morning</q></p>
      </dd>

      <dt>
        Cheoum Lee (Kevin)
        <span class="student-id">106523655</span>
      </dt>
      <dd>
        <p><strong>Contribution:</strong> Refactored about.html to meet all brief requirements, wrote the page CSS
          styling, and ran HTML5 and accessibility validation.</p>
        <p><strong>Quote (Korean):</strong> <q lang="ko">티끌 모아 태산</q></p>
        <p><strong>English:</strong> <q>Many small drops make a mighty ocean</q></p>
      </dd>

    </dl>
  </section>

  <!-- Fun facts table with caption -->
  <section>
    <h2 style="text-align: left; color: black; font-size: 1.2em;">Fun Facts</h2>
    <table class="fun-facts-table">
      <caption>Fun Facts About Our Team</caption>
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Fun Fact</th>
          <th scope="col">Favourite Coding Snack</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Elliot</th>
          <td>Owns over 3,000 LEGO minifigures</td>
          <td>Tim Tams</td>
        </tr>
        <tr>
          <th scope="row">Jaxon</th>
          <td>Can solve a Rubik's Cube in under 30 seconds</td>
          <td>Monster Energy Drink</td>
        </tr>
        <tr>
          <th scope="row">Kevin</th>
          <td>Is unemployed</td>
          <td>Ramen</td>
        </tr>
      </tbody>
    </table>
  </section>

  <!-- Team photo (using logo as placeholder) using inline CSS -->
  <figure>
    <img src="styles/images/MediZenLogo.jpeg" alt="MediZen team logo representing Group J.E.K">
    <figcaption style="font-style: italic;">
      Team J.E.K - the three-person team behind MediZen.
      Bringing together skills in web development, design,
      and digital healthcare to build this recruitment platform.
    </figcaption>
  </figure>
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
