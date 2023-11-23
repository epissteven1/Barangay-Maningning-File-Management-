<?php
include 'connection.php';

function logActivity($conn, $logMessage) {
    // Insert log entry into the activity_log table
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, $logMessage);

    $sql = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";
    mysqli_query($conn, $sql);
}

if (isset($_POST['submit'])) {
    $targetDirectory = "file_uploads/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
        logActivity($conn, "Created target directory: $targetDirectory");
    }

    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = array("pdf", "doc", "docx", "txt");

    if (!in_array($fileType, $allowedExtensions)) {
        logActivity($conn, "Failed to upload. Invalid file type: $fileType");
        echo "<script>alert('Sorry, only PDF, DOC, DOCX, and TXT files are allowed.');</script>";
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        logActivity($conn, "Failed to upload. File already exists: $targetFile");
        echo "<script>alert('Sorry, the file already exists.');</script>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        logActivity($conn, "Failed to upload. File size is too large.");
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        logActivity($conn, "Failed to upload the document.");
        echo "<script>alert('Sorry, your document was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $filePath = $targetDirectory . $fileName;

            $sql = "INSERT INTO documents (file_uploads, upload_date) VALUES ('$filePath', NOW())";
            if (mysqli_query($conn, $sql)) {
                logActivity($conn, "File information inserted into the database: $fileName");
                echo "<script>alert('File information inserted into the database.');</script>";
                header("Location: sample_docs.php");
                exit();
            } else {
                logActivity($conn, "Error: $sql \n" . mysqli_error($conn));
                echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>
