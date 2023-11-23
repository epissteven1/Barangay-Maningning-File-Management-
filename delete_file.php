<?php
include('connection.php');

function logActivity($conn, $message) {
    $timestamp = date("Y-m-d H:i:s");
    $message = mysqli_real_escape_string($conn, $message);
    $query = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$message')";
    mysqli_query($conn, $query);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT file_uploads FROM documents WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($fileName);

    if ($stmt->fetch()) {
        $stmt->close();

        if (file_exists($fileName)) {
            if (unlink($fileName)) {
                // Log the deletion activity
                $logMessage = "Deleted file: $fileName";
                logActivity($conn, $logMessage);

                // Delete the record from the database
                $deleteQuery = "DELETE FROM documents WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param("i", $id);

                if ($deleteStmt->execute()) {
                    echo "<script>alert('File deleted: " . $fileName . "');</script>";
                    $deleteStmt->close();
                    echo "<script>window.location = 'admin_docs.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Error deleting the file from the database.');</script>";
                }
                $deleteStmt->close();
            } else {
                echo "<script>alert('Error deleting the file. Please check file permissions.');</script>";
            }
        } else {
            echo "<script>alert('File not found at path: " . $fileName . "');</script>";
        }
    } else {
        echo "<script>alert('Document not found.');</script>";
        echo "<script>window.location = 'admin_docs.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Document ID parameter is missing.');</script>";
}
?>
