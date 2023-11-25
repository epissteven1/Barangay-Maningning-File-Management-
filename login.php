<?php
include_once "connection.php";


function logActivity($conn, $logMessage)
{
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, $logMessage);

    // Insert log entry into the activity_log table
    $sql = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";

    if (mysqli_query($conn, $sql)) {
        // Log entry was successfully inserted
        return true;
    } else {
        // Log entry insertion failed
        return false;
    }
}


session_start();

if (isset($_POST["login"])) {   
    $username = $_POST["username"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin_tb` WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                logActivity($conn, "Successful login for username: $username");
                header('Location: admin_index.php');
                exit();
            } else {
                logActivity($conn, "Failed login attempt for username: $username (Wrong Password)");
                echo '<script>alert("Wrong Password!")</script>';
            }
        } else {
            logActivity($conn, "Failed login attempt for username: $username (Username not found)");
            echo '<script>alert("Email or Username Not Found!")</script>';
        }
    } else {
        echo '<script>alert("Database Error!")</script>';
    }
}
?>

