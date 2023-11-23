<?php


// Start or resume the session
session_start();

if (!isset($_SESSION['admin_id'])) {
    // User is not authenticated, redirect to a login page
    header('Location: login.php');
    exit();
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];

        // Validate and move the uploaded file to a server directory
        $uploadDirectory = "file_uploads/";
        $targetPath = $uploadDirectory . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $targetPath)) {
            
            include 'connection.php';

            $filePath = $conn->real_escape_string($targetPath);
            $sql ="INSERT INTO documents (file_uploads, upload_date) VALUES ('$filePath', NOW())";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded and inserted into the database successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file selected.";
    }
}
?>
