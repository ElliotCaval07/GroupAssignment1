<?php
// apply.php
// EOI (Expression of Interest) form.
// ALL HTML5 client-side validation is disabled per the brief.
// ALL checks happen on the server in process_eoi.php.

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
    <meta name="description" content="Apply for a position at Medizen healthcare">
    <meta name="keywords" content="MediZen, apply, EOI, application">
    <meta name="author" content="J.E.K Group - MediZen">
    <title>Apply - MediZen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php include("includes/header.inc"); ?>
    <?php include("includes/nav.inc"); ?>

    <main>
        <h2>Expression of interest</h2>
        <p>
            please fill in all the required fields marked with 
            *. Validation runs on the server after you submit.
            
        </p>

        <form method="post" action="process_eoi.php" novalidate>

        <fieldset>
            <legend>Job Details</legend>
            <p>
                <label for="job_reference">Job Reference Number *</label>
                <input type="text" id="job_reference" name="job_reference" maxlength="5">
                <br><small>Exactly 5 letters or digits.</small>
            </p>
        </fieldset>

        <fieldset>
            <legend>Applicant Details</legend>
            <p>
                <label for="firstname">First Name *</label>
                <input type="text" id="firstname" name="firstname" maxlength="20">
                <br><small>Letters only, max 20 characters.</small>
            </p>
            <p>
                <label for="lastname">Last Name *</label>
                <input type="text" id="lastname" name="lastname" maxlength="20">
                <br><small>Letters only, max 20 characters.</small>
            </p>
            <p>
                <label for="dob">Date of Birth *</label>
                <input type="text" id="dob" name="dob" maxlength="10" placeholder="dd//mm//yyyy">
                <br><small>Format: dd/mm/yyyy. Must be 15 to 80 years old.</small>
            </p>
            <p>
                Gender *
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="Other">
                <label for="other">Other</label>
            </p>
        </fieldset>

        <fieldset>
            <legend>Contact</legend>
            <p>
                <label for="email">Email *</label>
                <input type="text" id="email" name="email" maxlength="80">
                <br><small>Valid email adress (e.g. you@example.com).</small>
            </p>
            <p>
                <label for="phone">Phone Number *</label>
                <input type="text" id="phone" name="phone" maxlength="12">
                <br><small?>8 to 12 digits and spaces only.</small>
            </p>
        </fieldset>

        <fieldset>
            <legend>Postal Address</legend>
            <p>
                <label for="street">Street Address *</label>
                <input type="text" id="street" name="street" maxlength="40">
            </p>
            <p>
                <label for="suburb">Suburb *</label>
                <input type="text" id="suburb" name="suburb" maxlength="40">
            </p>
            <p>
                <label for="state">State *</label>
                <select id="state" name="state">
                    <option value="">Please select</option>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="NT">NT</option>
                    <option value="ACT">ACT</option>
                </select>
            </p>
            <p>
                <label for="postcode">Postcode *</label>
                <input type="text" id="postcode" name="postcode" maxlength="4">
                <br><small>Exactly 4 digits.</small>
            </p>
        </fieldset>

        <fieldset>
            <legend>Skills</legend>
            <p>
                <input type="checkbox" name="medical_terminology" value="1">
                Medical terminology<br>
                <input type="checkbox" name="health_safety" value="1">
                Health and safety procedures<br>
                <input type="checkbox" name="infection_control" value="1">
                Infection control awareness<br>
                <input type="checkbox" name="documentation" value="1">
                Documentation and record keeping<br>
                <input type="checkbox" name="patient_workflows" value="1">
                Patient care workflows<br>
                <input type="checkbox" name="office_workspace" value="1">
                Microsoft Office / Google Workspace<br>
                <input type="checkbox" name="cybersecurity" value="1">
                Cybersecurity awareness<br>
                <input type="checkbox" name="data_entry" value="1">
                Data entry and accuracy<br>
                <input type="checkbox" name="ehr_systems" value="1">
                Electronic Health Records<br>
                <input type="checkbox" name="scheduling_systems" value="1">
                Digital scheduling systems<br>
                <input type="checkbox" name="first_aid" value="1">
                First Aid / CPR<br>
                <input type="checkbox" name="customer_service" value="1">
                Customer service experience<br>
                <input type="checkbox" name="healthcare_wellness" value="1">
                Healthcare or wellness experience<br>
                <input type="checkbox" name="multilingual" value="1">
                Multilingual communication<br>
                <input type="checkbox" name="knowledge_nutrition" value="1">
                Knowledge of nutrition basics<br>
            </p>
            <p>
                <label for="other_skills">Other Skills</label><br>
                <textarea id="other_skills" name="other_skills" rows="4" cols="40" maxlength="500"></textarea>
            </p>
        </fieldset>

            <p>
                <input type="submit" value="Submit Application">
                <input type="reset" value"Reset Form">
            </p>
        </form>
    </main>

    <?php include("includes/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>

</html>
