<?php

    require_once("settings.php");

    function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    function buildUrl($sort) {
        
        $select = sanitise_input($_GET['select']) ?? "";
        $where = sanitise_input($_GET['where']) ?? "";

        return "?sort=$sort&select=" . urlencode($select) . "&where=" . urlencode($where);
    }

    if (isset($_POST['delete'])) {
        $EOInum = $_POST['EOInum'];


        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE EOInumber = ?");
        mysqli_stmt_bind_param($stmt, "i", $EOInum);
        mysqli_stmt_execute($stmt);


    }

    if (isset($_POST['deleteJob'])) {
        $jobNum = $_POST['jobDelSelect'];


        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE job_reference = ?");
        mysqli_stmt_bind_param($stmt, "s", $jobNum);
        mysqli_stmt_execute($stmt);

    }

    if (isset($_POST['changeStat'])) {
        $EOInum = $_POST['EOInum'];
        $currentStat = $_POST['currentStat'];

        switch ($currentStat) {

            case 'New':
                $newStat = 'Current';
                break;
            
            case 'Current':
                $newStat = 'Final';
                break;


            default:
                $newStat = 'New';

        }

        $stmt = mysqli_prepare($conn, "UPDATE eoi SET status = ? WHERE EOInumber = ?");
        mysqli_stmt_bind_param($stmt, "si", $newStat, $EOInum);
        mysqli_stmt_execute($stmt);

    }

    $order = $_GET['sort'] ?? 'EOInumber';
    $select = sanitise_input($_GET['select']) ?? "";
    $where = sanitise_input($_GET['where']) ?? "";



    $allowedSort = ['EOInumber', 'job_reference', 'first_name', 'last_name', 'dob', 'gender', 'street_address', 'suburb', 'state', 'postcode', 'email', 'phone', 'status', 'submitted_at'];
    $allowedSelect = ['job_reference', 'first_name', 'last_name', 'both'];

    if (!in_array($order, $allowedSort)) {
    $order = 'EOInumber';
    }

    if (!in_array($select, $allowedSelect)) {
    $select = '';
    }

    if ($select && $where) {
        if ($select != 'both') {
        $query = "SELECT * FROM eoi WHERE $select = ? ORDER BY $order";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "s", $where);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        }else{

            $where = trim($where);
            $split = explode(" " , $where, 2);

            $firstName = $split[0];
            $secondName = $split[1] ?? "";

            $query = "SELECT * FROM eoi WHERE first_name = ? AND last_name = ? ORDER BY $order";
            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param($stmt, "ss", $firstName, $secondName);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
        }
    }else {
        $query  = "SELECT * FROM `eoi` ORDER BY $order";
        $result = mysqli_query($conn, $query);
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
    <title>Manage</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Site header: logo and tagline -->
    <?php include("includes/header.inc"); ?>

    <!-- Main navigation menu -->
    <?php include("includes/nav.inc"); ?>

    <main style="max-width: 1300px;">
        <!-- TODO: page-specific content goes here -->
        <h2>Manage</h2>
        <table style="font-size: 10px; border-bottom: 2px solid #1a5490;">

        <tr>
            <th><a href="<?= buildUrl('EOInumber')?>">EOInumber</a></th>
            <th><a href="<?= buildUrl('job_reference')?>">Job number</a></th>
            <th><a href="<?= buildUrl('first_name')?>">First name</a></th>
            <th><a href="<?= buildUrl('last_name')?>">last name</a></th>
            <th><a href="<?= buildUrl('dob')?>">dob</a></th>
            <th><a href="<?= buildUrl('gender')?>">Gender</a></th>
            <th><a href="<?= buildUrl('street_address')?>">Street Address</a></th>
            <th><a href="<?= buildUrl('suburb')?>">Suburb</a></th>
            <th><a href="<?= buildUrl('state')?>">State</a></th>
            <th><a href="<?= buildUrl('postcode')?>">Postcode</a></th>
            <th><a href="<?= buildUrl('email')?>">Email</a></th>
            <th><a href="<?= buildUrl('phone')?>">Phone</a></th>
            <th>Skills</th>
            <th>Other skills</th>
            <th><a href="<?= buildUrl('status')?>">Status</a></th>
            <th><a href="<?= buildUrl('submitted_at')?>">Date submitted</a></th>
        </tr>       
        <?php while ($row = mysqli_fetch_assoc($result)) {

            $skills = array();

            if ($row['skill_medical_terminology']) {$skills[] = 'Medical terminology';}
            if ($row['skill_health_safety']) {$skills[] = 'Health and safety procedures';}
            if ($row['skill_infection_control']) {$skills[] = 'Infection control awareness';}
            if ($row['skill_documentation']) {$skills[] = 'Documentation and record keeping';}
            if ($row['skill_patient_workflows']) {$skills[] = 'Patient care workflows';}
            if ($row['skill_office_workspace']) {$skills[] = 'Microsoft Office / Google Workspace';}
            if ($row['skill_cybersecurity']) {$skills[] = 'Cybersecurity awareness';}
            if ($row['skill_data_entry']) {$skills[] = 'Data entry and accuracy';}
            if ($row['skill_ehr_systems']) {$skills[] = 'Data entry and accuracy';}
            if ($row['skill_scheduling_systems']) {$skills[] = 'Digital scheduling systems';}
            if ($row['skill_first_aid']) {$skills[] = 'First Aid / CPR';}
            if ($row['skill_customer_service']) {$skills[] = 'Customer service experience';}
            if ($row['skill_healthcare_wellness']) {$skills[] = 'Healthcare or wellness experience';}
            if ($row['skill_multilingual']) {$skills[] = 'Multilingual communication';}
            if ($row['skill_knowledge_nutrition']) {$skills[] = 'Knowledge of nutrition basics';}

        ?>

        <tr>
        <td> <?php echo $row['EOInumber']; ?> </td>
        <td> <?php echo $row['job_reference']; ?> </td>
        <td> <?php echo $row['first_name']; ?> </td>
        <td> <?php echo $row['last_name']; ?> </td>
        <td> <?php echo $row['dob']; ?> </td>
        <td> <?php echo $row['gender']; ?> </td>
        <td> <?php echo $row['street_address']; ?> </td>
        <td> <?php echo $row['suburb']; ?> </td>
        <td> <?php echo $row['state']; ?> </td>
        <td> <?php echo $row['postcode']; ?> </td>
        <td> <?php echo $row['email']; ?> </td>
        <td> <?php echo $row['phone']; ?> </td>
        <td style="font-size: 9px;" > 
            <?php foreach ($skills as $skill) {
                echo $skill . "<br>";
            } ?> 
        </td>
        <td> <?php echo $row['other_skills']; ?> </td>
        <td> 
            <form method='post'>
                <input type='hidden' name='EOInum' value='<?php echo $row['EOInumber']; ?>'>
                <input type='hidden' name='currentStat' value='<?php echo $row['status']; ?>'>
                <button class="status-btn" type='submit' name='changeStat'><?php echo $row['status']; ?></button>
            </form>

        </td>
        <td> <?php echo $row['submitted_at']; ?> </td>
        <td>
            <form method='post'>
                <input type='hidden' name='EOInum' value='<?php echo $row['EOInumber']; ?>'>
                <button class="small-btn" type='submit' name='delete'>Delete</button>
            </form>
        </td>
        </tr>




        <?php 
        }
        ?>

        
        
        </table>


        <br>

        <?php if (mysqli_num_rows($result) == 0){ ?>
            
        <p style="color: red;"><Strong>No EOI results were found</strong></p>
        <br>
        <?php } ?>

        <div class="container">
            <div class="section">
                <h3> Manager filtering </h3>

                <form method="GET" action="manage.php"> 
                    <p>
                        <select name="select" id="select">
                            <option value="" disabled selected>Select what field to filter</option>
                            <option value="job_reference">Job number</option>
                            <option value="first_name">First name</option>
                            <option value="last_name">Last name</option>
                            <option value="both">Full name</option>
                        </select>

                        <input type="text" id="where" name="where" maxlength="50">
                    </p>

                    <p>
                        <input type="submit" value="Filter">
                    </p>

                </form>
            </div>

            <div class="section">
                <h3> Delete Job </h3>

                <form method="post">
                    <input type="text" name="jobDelSelect" placeholder="enter job reference">

                    <button type="submit" name="deleteJob">
                        Delete
                    </button>
                </form>


            </div>
        </div>


        <style>
            th a {
                color: white;          
                text-decoration: none; 
            }

            th a:hover {
                text-decoration: underline; 
            }

            button {
                background-color: #ff0000;
                color: white;
            }

            .small-btn {
                background-color: #ff0000;
                color: white;
                font-size: 12px;
                padding: 4px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .small-btn:hover {
                background-color: #CC0000;
            }

            .status-btn {
                background-color: #1a5490;
                color: white;
                font-size: 12px;
                padding: 4px 8px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }


            .container {
                display: flex;
                gap: 10px; 
            }

            .section {
                flex: 1; 
                padding: 20px;
            }
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
