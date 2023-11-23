<?php
include 'connection.php';
$file_id = $_GET['file_id'];



// Rest of your code for handling file download
// Check if the permission is granted (status is 'Accepted')
$checkPermissionQuery = "SELECT * FROM permission_requests WHERE file_id = ? AND status = 'Accepted'";

// Debugging statement
echo 'Permission check query: ' . $checkPermissionQuery . '<br>';

$stmt = mysqli_prepare($conn, $checkPermissionQuery);
mysqli_stmt_bind_param($stmt, "i", $file_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Debugging statement for the result of the permission check query
echo 'Number of rows in result set: ' . mysqli_num_rows($result) . '<br>';

if ($row = mysqli_fetch_assoc($result)) {
    // Fetch the file path from the database
    $file_path_query = "SELECT file_uploads FROM documents WHERE file_id = ?";
    $stmt_path = mysqli_prepare($conn, $file_path_query);
    mysqli_stmt_bind_param($stmt_path, "i", $file_id);
    mysqli_stmt_execute($stmt_path);
    $result_path = mysqli_stmt_get_result($stmt_path);

    // Check if the file path is retrieved successfully
    if ($row_path = mysqli_fetch_assoc($result_path)) {
        $file_path = $row_path['file_uploads'];

        // Debugging statements
        echo 'File path from database: ' . $file_path . '<br>';

        // Construct the absolute file path
        $absolute_file_path = __DIR__ . '/file_uploads/' . $file_path;


        // Debugging statement1. You should remove this debugging statement before deployment.
        echo 'Absolute file path: ' . $absolute_file_path . '<br>';

        // Check if the file exists
        if (file_exists($absolute_file_path)) {
            // If the file exists, set the appropriate headers and read the file content
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($absolute_file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($absolute_file_path));
            readfile($absolute_file_path);
        } else {
            // If the file does not exist, display an error message
            echo 'Error: File not found.';
        }
    } else {
        echo 'Error: File path not retrieved from the database.';
    }
} else {
    echo 'Error: No permission entry found for file_id ' . $file_id . ' with status "Accepted".';
}

// Close the statements
mysqli_stmt_close($stmt_path);

// Close the database connection
mysqli_close($conn);
?>