<?php
include_once "connection.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: applicant_login.php");
    exit();
}

if (isset($_POST["change_password"])) {
    // Get form data
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($conn, $_POST['confirm_new_password']);

    // Get the current user's username from the session
    $id = $_SESSION["id"];

    // Validate current password
    $sql = "SELECT password FROM applicants WHERE applicant_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($current_password, $hashed_password)) {
            // Validate new password match
            if ($new_password !== $confirm_new_password) {
                $password_err = "New passwords do not match";
                echo '<script>alert("New passwords do not match."); window.location.href = "change_password_form.php";</script>';
                exit();
            }

            // Validate new password length
            if (strlen($new_password) < 6) {
                $password_err = "New password must be at least 6 characters";
                echo '<script>alert("New password must be at least 6 characters.");window.location.href = "change_password_form.php";</script>';
                exit();
            }

            // Hash new password
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update user's password in the database
            $update_sql = "UPDATE applicants SET password = '$new_password' WHERE applicant_id = '$id'";
            if (mysqli_query($conn, $update_sql)) {
                // Log the activity
                echo '<script>alert("Password changed successfully";); window.location.href = "change_password_form.php";</script>';
                exit();
            } else {

                echo '<script>alert("Error changing password";); window.location.href = "change_password_form.php";</script>';
                 exit();      
            }

        } else {
            $password_err = "Current password is incorrect";
            echo '<script>alert("Current password is incorrect.");</script>';
        }
    } else {
        $error_message = "Error fetching current password: " . mysqli_error($conn);
        echo '<script>alert("Error fetching current password: ' . mysqli_error($conn) . '");</script>';
    }
}
?>
