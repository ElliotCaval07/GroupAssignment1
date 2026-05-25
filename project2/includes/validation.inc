<?php
// validation.inc
// Server-side validation functions used by process_eoi.php.
// Owner: Kevin (Task 4)
//
// Each function returns either an empty string (valid) or an error message.
// Keeping the rules in one place makes them easy to read and maintain.

// ===== Generic input cleaner =====
// Strips outer whitespace, removes any sneaky slashes, and escapes HTML.
// Run this on every text field BEFORE validating.
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// ===== Job reference - exactly 5 letters or digits =====
function check_job_reference($value) {
    if ($value === '') {
        return "Job reference is required.";
    }
    if (!preg_match("/^[A-Za-z0-9]{5}$/", $value)) {
        return "Job reference must be exactly 5 letters or digits.";
    }
    return '';
}

// ===== Name (first/last) - letters, spaces, hyphens, apostrophes =====
function check_name($value, $field_label) {
    if ($value === '') {
        return "$field_label is required.";
    }
    if (strlen($value) > 20) {
        return "$field_label must be 20 characters or fewer.";
    }
    if (!preg_match("/^[A-Za-z' \-]+$/", $value)) {
        return "$field_label can only contain letters, spaces, hyphens or apostrophes.";
    }
    return '';
}

// ===== Date of birth - format dd/mm/yyyy, age 15 to 80 =====
// Returns ['error' => string, 'mysql_date' => string]
// mysql_date is the value converted to YYYY-MM-DD for the DB column.
function check_dob($value) {
    if ($value === '') {
        return ['error' => "Date of birth is required.", 'mysql_date' => ''];
    }

    // Try to parse dd/mm/yyyy
    $dob = DateTime::createFromFormat('d/m/Y', $value);
    if (!$dob || $dob->format('d/m/Y') !== $value) {
        return ['error' => "Date of birth must be in dd/mm/yyyy format.", 'mysql_date' => ''];
    }

    $today = new DateTime('today');
    if ($dob > $today) {
        return ['error' => "Date of birth cannot be in the future.", 'mysql_date' => ''];
    }

    $age = $today->diff($dob)->y;
    if ($age < 15 || $age > 80) {
        return ['error' => "Applicant must be between 15 and 80 years old.", 'mysql_date' => ''];
    }

    return ['error' => '', 'mysql_date' => $dob->format('Y-m-d')];
}

// ===== Gender - one of three allowed values =====
function check_gender($value) {
    $allowed = ['Male', 'Female', 'Other'];
    if (!in_array($value, $allowed, true)) {
        return "Please select a gender.";
    }
    return '';
}

// ===== Street address - non-empty, max 40 chars =====
function check_street($value) {
    if ($value === '') {
        return "Street address is required.";
    }
    if (strlen($value) > 40) {
        return "Street address must be 40 characters or fewer.";
    }
    return '';
}

// ===== Suburb - non-empty, max 40 chars =====
function check_suburb($value) {
    if ($value === '') {
        return "Suburb is required.";
    }
    if (strlen($value) > 40) {
        return "Suburb must be 40 characters or fewer.";
    }
    return '';
}

// ===== State - one of the valid Australian states/territories =====
function check_state($value) {
    $allowed = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
    if (!in_array($value, $allowed, true)) {
        return "Please select a valid Australian state or territory.";
    }
    return '';
}

// ===== Postcode - 4 digits AND must match the chosen state =====
function check_postcode($postcode, $state) {
    if ($postcode === '') {
        return "Postcode is required.";
    }
    if (!preg_match("/^[0-9]{4}$/", $postcode)) {
        return "Postcode must be exactly 4 digits.";
    }

    // Australian rule: the first digit of the postcode must match the state
    $rules = [
        'VIC' => ['3','8'],
        'NSW' => ['1','2'],
        'QLD' => ['4','9'],
        'NT'  => ['0'],
        'WA'  => ['6'],
        'SA'  => ['5'],
        'TAS' => ['7'],
        'ACT' => ['0','2'],
    ];

    if (!isset($rules[$state])) {
        return "Cannot check postcode without a valid state.";
    }

    $first_digit = substr($postcode, 0, 1);
    if (!in_array($first_digit, $rules[$state], true)) {
        $valid_starts = implode(' or ', $rules[$state]);
        return "Postcode does not match $state. $state postcodes start with $valid_starts.";
    }
    return '';
}

// ===== Email - format check using PHP's built-in filter =====
function check_email($value) {
    if ($value === '') {
        return "Email is required.";
    }
    if (strlen($value) > 80) {
        return "Email must be 80 characters or fewer.";
    }
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return "Email address is not in a valid format.";
    }
    return '';
}

// ===== Phone - 8 to 12 characters, digits and spaces only =====
function check_phone($value) {
    if ($value === '') {
        return "Phone number is required.";
    }
    if (!preg_match("/^[0-9 ]{8,12}$/", $value)) {
        return "Phone must be 8 to 12 characters, digits and spaces only.";
    }
    return '';
}

// ===== Other skills - optional, but limit length if filled in =====
function check_other_skills($value) {
    if (strlen($value) > 500) {
        return "Other skills must be 500 characters or fewer.";
    }
    return '';
}
?>
