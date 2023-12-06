<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    // You should perform additional validation and security checks here

    // Assuming you have a table named 'applicants' and the user is identified by some unique field (e.g., 'user_id')
    session_start(); // Assuming you are using sessions to store user information
    $admin_id = $_SESSION['admin_id'];

    // Check if the current password matches the one stored in the database
    $checkPasswordQuery = "SELECT * FROM admin_tb WHERE admin_id = '$admin_id'";
    $result = mysqli_query($conn, $checkPasswordQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Verify the current password using password_verify
        if (password_verify($currentPassword, $row['password'])) {
            // Current password is correct, update the password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updatePasswordQuery = "UPDATE admin_tb SET password = '$hashedPassword' WHERE admin_id = '$admin_id'";
            $updateResult = mysqli_query($conn, $updatePasswordQuery);

            if ($updateResult) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "Incorrect current password";
        }
    } else {
        echo "Error checking current password: " . mysqli_error($conn);
    }
}

mysqli_close($conn  );
?>
