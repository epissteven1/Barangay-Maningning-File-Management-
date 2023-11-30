<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];

    if ($role === "admin") {
        // Load admin login form
        include "admin_form.php";
    } elseif ($role === "applicant") {
        // Load applicant login form
        include "applicant_form.php";
    } else {
        // Handle invalid role
        echo "Invalid role selected.";
    }
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
