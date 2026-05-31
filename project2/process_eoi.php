<?php
// process_eoi.php
// Handles the EOI from submission from apply.php.

require_once("settings.php");

// Sanitise function from Week 7 PHP2 lecture
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediZen application result">
    <meta name="keywords" content="MediZen, application, EOI">
    <meta name="author" content="J.E.K Group - MediZen">
    <title>Application - MediZen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include("includes/header.inc"); ?>
    <?php include("includes/nav.inc"); ?>

    <main>
        <?php
        // STEP 1: Block direct URL access
        // If the user typed this URL into the browser, $_POST is empty.
        // Show a message and stop.
        if (!isset($_POST['job_reference'])) {
            echo "<h2>Please use the application form</h2>";
            echo "<p>You cannot access this page directly. ";
            echo "Please <a href='apply.php'>go to the apply page</a>.</p>";
        } else {
            // STEP 2: Create the eoi table if it does not exist yet
            // This is required by the brief: "If eoi table does not exist, 
            // create it in code."
            $create_sql = "CREATE TABLE IF NOT EXISTS eoi (
                EOInumber INT AUTO_INCREMENT PRIMARY KEY,
                job_reference CHAR(5) NOT NULL, 
                first_name VARCHAR(20) NOT NULL, 
                last_name VARCHAR(20) NOT NULL, 
                dob DATE NOT NULL,
                gender VARCHAR(10) NOT NULL,
                street_address VARCHAR(40) NOT NULL,
                suburb VARCHAR(40) NOT NULL,
                state VARCHAR(3) NOT NULL,
                postcode CHAR(4) NOT NULL,
                email VARCHAR(80) NOT NULL,
                phone VARCHAR(12) NOT NULL,
                skill_medical_terminology BOOLEAN DEFAULT FALSE,
                skill_health_safety BOOLEAN DEFAULT FALSE,
                skill_infection_control BOOLEAN DEFAULT FALSE,
                skill_documentation BOOLEAN DEFAULT FALSE,
                skill_patient_workflows BOOLEAN DEFAULT FALSE,
                skill_office_workspace BOOLEAN DEFAULT FALSE,
                skill_cybersecurity BOOLEAN DEFAULT FALSE,
                skill_data_entry BOOLEAN DEFAULT FALSE,
                skill_ehr_systems BOOLEAN DEFAULT FALSE,
                skill_scheduling_systems BOOLEAN DEFAULT FALSE,
                skill_first_aid BOOLEAN DEFAULT FALSE,
                skill_customer_service BOOLEAN DEFAULT FALSE,
                skill_healthcare_wellness BOOLEAN DEFAULT FALSE,
                skill_multilingual BOOLEAN DEFAULT FALSE,
                skill_knowledge_nutrition BOOLEAN DEFAULT FALSE,
                other_skills TEXT,
                status VARCHAR(10) DEFAULT 'New',
                submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            mysqli_query($conn, $create_sql);

            // STEP 3: Sanitise all inputs (Week 7 PHP2 pattern)
            $job_reference = sanitise_input($_POST['job_reference']);
            $firstname = sanitise_input($_POST['firstname']);
            $lastname = sanitise_input($_POST['lastname']);
            $dob = sanitise_input($_POST['dob']);
            $gender = sanitise_input($_POST['gender']);
            $street = sanitise_input($_POST['street']);
            $suburb = sanitise_input($_POST['suburb']);
            $state = sanitise_input($_POST['state']);
            $postcode = sanitise_input($_POST['postcode']);
            $email = sanitise_input($_POST['email']);
            $phone = sanitise_input($_POST['phone']);
            $other_skills = sanitise_input($_POST['other_skills']);

            // Checkboxes - if ticked, $_POST has the value, otherwise it does not
            if (isset($_POST['medical_terminology'])) { $skill_mt = 1; } else { $skill_mt = 0; }
            if (isset($_POST['health_safety'])) { $skill_hs = 1; } else { $skill_hs = 0; }
            if (isset($_POST['infection_control'])) { $skill_ic = 1; } else { $skill_ic = 0; }
            if (isset($_POST['documentation'])) { $skill_doc = 1; } else { $skill_doc = 0; }
            if (isset($_POST['patient_workflows'])) { $skill_pw = 1; } else { $skill_pw = 0; }
            if (isset($_POST['office_workspace'])) { $skill_ow = 1; } else { $skill_ow = 0; }
            if (isset($_POST['cybersecurity'])) { $skill_cs = 1; } else { $skill_cs = 0; }
            if (isset($_POST['data_entry'])) { $skill_de = 1; } else { $skill_de = 0; }
            if (isset($_POST['ehr_systems'])) { $skill_ehr = 1; } else { $skill_ehr = 0; }
            if (isset($_POST['scheduling_systems'])) { $skill_ss = 1; } else { $skill_ss = 0; }
            if (isset($_POST['first_aid'])) { $skill_fa = 1; } else { $skill_fa = 0; }
            if (isset($_POST['customer_service'])) { $skill_cust = 1; } else { $skill_cust = 0; }
            if (isset($_POST['healthcare_wellness'])) { $skill_hw = 1; } else { $skill_hw = 0; }
            if (isset($_POST['multilingual'])) { $skill_ml = 1; } else { $skill_ml = 0; }
            if (isset($_POST['knowledge_nutrition'])) { $skill_kn = 1; } else { $skill_kn = 0; }

            // STEP 4: Validate each field (Week 7 PHP2 $err_msg patterm)
            $err_msg = "";

            // Job reference - exactly 5 letters or digits
            if (strlen($job_reference) == 0) {
                $err_msg .="<p>Please enter the job reference number.</p>";
            } else if (strlen($job_reference) != 5) {
                $err_msg .="<p>Job references must be exactly 5 characters.</p>";
            } else if (!preg_match("/^[a-zA-Z0-9]*$/", $job_reference)) {
                $err_msg .= "<p>Job reference must contain only letters and digits.</p>";
            }

            // First name - letters and spaces only, max 20 (Week 7 PHP2 example)
            if (strlen($firstname) == 0) {
                $err_msg .= "<p>Please enter your first name.</p>";
            } else if (strlen($firstname) > 20) {
                $err_msg .= "<p>First name must be 20 characters or fewer.</p>";
            } else if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
                $err_msg .= "<p>First name can only contain letters and spaces.</p>";
            }

            // Last name - same rules
            if (strlen($lastname) == 0) {
                $err_msg .= "<p>Please enter your last name.</p>";
            } else if (strlen($lastname) > 20) {
                $err_msg .= "<p>Last name must be 20 characters or fewer.</p>";
            } else if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
                $err_msg .= "<p>Last name can only contain letters and spaces.</p>";
            }

            // Date of birth - using explode (Week 7 PHP2 Appendix pattern)
            $dob_mysql = "";
            if (strlen($dob) == 0) {
                $err_msg .= "<p>Please enter your date of birth.</p>";
            } else {
                $dobArr = explode('/', $dob);
                 if (count($dobArr) != 3) {
                    $err_msg .= "<p>Date of birth must be in dd/mm/yyyy format.</p>";
                } else {

                    // Convert dd/mm/yyyy to MySQL yyyy-mm-dd
                    $dob_mysql = $dobArr[2] . "-" . $dobArr[1] . "-" . $dobArr[0];
                }
            }

            // Gender - must pick one
            if (strlen($gender) == 0) {
                $err_msg .= "<p>Please select your gender.</p>";
            }

            // Street address
            if (strlen($street) == 0) {
                $err_msg .= "<p>Please enter your street address.</p>";
            } else if (strlen($street) > 40) {
                $err_msg .= "<p>Street address must be 40 characters or fewer.</p>";
            }

            // Suburb
            if (strlen($suburb) == 0) {
                $err_msg .= "<p>Please enter your suburb.</p>";
            } else if (strlen($suburb) > 40) {
                $err_msg .= "<p>Suburb must be 40 characters or fewer.</p>";
            }

            // State - one of the dropdown values
            if (strlen($state) == 0) {
                $err_msg .= "<p>Please select your state.</p>";
            }

            // Postcode - exactly 4 digits
            if (strlen($postcode) == 0) {
                $err_msg .= "<p>Please enter your postcode.</p>";
            } else if (strlen($postcode) != 4) {
                $err_msg .= "<p>Postcode must be exactly 4 digits.</p>";
            } else if (!preg_match("/^[0-9]*$/", $postcode)) {
                $err_msg .= "<p>Postcode must contain only digits.</p>";
            }

            // Email - filter_var (Week 7 PHP2 + Week 11 example)
            if (strlen($email) == 0) {
                $err_msg .= "<p>Please enter your email.</p>";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err_msg .= "<p>Email address is not in a valid format.</p>";
            }

            // Phone - 8 to 12 characters, digits and spaces
            if (strlen($phone) == 0) {
                $err_msg .= "<p>Please enter your phone number.</p>";
            } else if (strlen($phone) < 8 || strlen($phone) > 12) {
                $err_msg .= "<p>Phone must be between 8 and 12 characters.</p>";
            } else if (!preg_match("/^[0-9 ]*$/", $phone)) {
                $err_msg .= "<p>Phone must contain only digits and spaces.</p>";
            }

            // STEP 5: Decide what to do based on validation result
            if ($err_msg !="") {
                // 5a. There are errors - show them
                echo "<h2>We could not save your application</h2>";
                echo "<p>Please fix the following and try again: </p>";
                echo $err_msg;
                echo "<p><a href='apply.php'>Back to the application for</a></p>";
            } else {
                // 5b. No errors - save to the database (Week 10 INSERT pattern)
                // First, escape strings to block SQL injection (Week 9 Lab pattern)
                $job_reference = mysqli_real_escape_string($conn, $job_reference);
                $firstname = mysqli_real_escape_string($conn, $firstname);
                $lastname = mysqli_real_escape_string($conn, $lastname);
                $gender = mysqli_real_escape_string($conn, $gender);
                $street = mysqli_real_escape_string($conn, $street);
                $suburb = mysqli_real_escape_string($conn, $suburb);
                $state = mysqli_real_escape_string($conn, $state);
                $postcode = mysqli_real_escape_string($conn, $postcode);
                $email = mysqli_real_escape_string($conn, $email);
                $phone = mysqli_real_escape_string($conn, $phone);
                $other_skills = mysqli_real_escape_string($conn, $other_skills);

                // Build the INSERT statement
                $insert_sql = "INSERT INTO eoi (
                    job_reference, first_name, last_name, dob, gender,
                    street_address, suburb, state, postcode, email, phone,
                    skill_medical_terminology, skill_health_safety, skill_infection_control,
                    skill_documentation, skill_patient_workflows,
                    skill_office_workspace, skill_cybersecurity, skill_data_entry,
                    skill_ehr_systems, skill_scheduling_systems,
                    skill_first_aid, skill_customer_service, skill_healthcare_wellness,
                    skill_multilingual, skill_knowledge_nutrition,
                    other_skills
                ) VALUES (
                    '$job_reference', '$firstname', '$lastname', '$dob_mysql', '$gender',
                    '$street', '$suburb', '$state', '$postcode', '$email', '$phone',
                    $skill_mt, $skill_hs, $skill_ic,
                    $skill_doc, $skill_pw,
                    $skill_ow, $skill_cs, $skill_de,
                    $skill_ehr, $skill_ss,
                    $skill_fa, $skill_cust, $skill_hw,
                    $skill_ml, $skill_kn,
                    '$other_skills'
                )";

                $insert_result = mysqli_query($conn, $insert_sql);

                if ($insert_result) {
                    // Get the auto-generated EOInumber
                    $eoi_number = mysqli_insert_id($conn);

                    // Show sucess with EOInumber (required by the brief)
                    echo "<h2>Thanks, " . $firstname . "!</h2>";
                    echo "<p>Your application has been received.</p>";
                    echo "<p><strong>Your EOI number is: " . $eoi_number . "</strong></p>";
                    echo "<p>Please keep this number for your records.</p>";
                    echo "<p><a href='index.php'>Back to Home</a></p>";
                } else {
                    echo "<p>Save failed: " . mysqli_error($conn) . "</p>";
                }
            }

            // Close the database connection (Week 9 pattern)
            mysqli_close($conn);
        }
        ?>
    </main>

    <?php include("include/acknowledgement.inc"); ?>
    <?php include("includes/footer.inc"); ?>
</body>
</html>