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

<!DOCTYPE html>
<html lang="en">
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        padding: 20px;
        width: 300px;
        text-align: center;
    }

    h2 {
        margin: 0;
        background-color: beige;
        color: black;
        border-radius: 5px;
        padding: 10px;
        margin-top: -20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin: 20px 0;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        width: 90%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
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
        transition: background-color 0.3s ease-in-out;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Style for the dropdown button */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<head>

</head>

<body>

    <div class="login-container">
        <h2>Login</h2>
        <div class="dropdown">
            <button class="dropbtn" id="selectedRole">Select Role</button>
            <div class="dropdown-content">
                <a href="login.php" onclick="setRole('Admin')">Admin</a>
                <a href="applicant_login.php" onclick="setRole('Applicant')">Applicant</a>
            </div>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" name="login">
            </div>
            <a href="register.php">Don't have an account?</a>
        </form>
    </div>

    <script>
        function setRole(role) {
            document.getElementById("selectedRole").textContent = role;
        }

        function toggleDropdown() {
            var dropdown = document.getElementById("roleDropdown");
            if (dropdown.classList.contains("show-dropdown")) {
                dropdown.classList.remove("show-dropdown");
            } else {
                dropdown.classList.add("show-dropdown");
            }
        }

        // Close the dropdown when the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show-dropdown')) {
                        openDropdown.classList.remove('show-dropdown');
                    }
                }
            }
        }
    </script>
</body>

</html>