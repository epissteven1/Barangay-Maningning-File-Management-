<?php include 'connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    


    
    $query = "SELECT * FROM admin_tb WHERE admin_id = $admin_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
    }else{
             // Handle query error, e.g., log the error, redirect, or display a message
             echo "Error: " . mysqli_error($conn);
    }

} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();
}
?>