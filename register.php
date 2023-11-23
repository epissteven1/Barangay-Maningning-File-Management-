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
            echo "<script>alert('Registration successful. You can now log in.'); window.location.href = 'login.php';</script>";
         
        
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: lavender;
        }

        .register-container {
            
        background-color: #f9f9f9;
            max-width: 330px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background: transparent;
            backdrop-filter: blur(15px);
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        h2 {            
            width: fit-content;
            margin-left: 40%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="fullname">Fullname:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password_1" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password:</label>
                <input type="password" name="password_2" required>
            </div>
            <div class="form-group">
                <input type="submit" name="register" value="Register">
            </div>
            <a href="applicant_login.php">Already have an account?</a>
        </form>
    </div>
</body>
</html>