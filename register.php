<?php
include_once "connection.php";

if (isset($_POST["register"])) {

    // Get form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email =    $_POST['email']; 
    $password = $_POST['password_1']; // Corrected the variable name
    $confirm_password = $_POST['password_2'];

    // Validate password match
    if($password !== $confirm_password){
        $password_err = "Passwords do not match";
    }

    // Validate password length
    if(strlen($password) < 6){
        $password_err = "Password must be at least 6 characters";
    }


    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database using prepared statement
    $sql = "INSERT INTO admin_tb (fullname, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $username, $email, $hashed_password);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registration successful. You can now log in.'); window.location.href = 'admin_form.php';</script>";
         
        
            exit();
        } else {    
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>