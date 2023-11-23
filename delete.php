<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query your database to get the file name and other details for the given ID
    $query = "SELECT file_uploads FROM documents WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($fileName);

    if ($stmt->fetch()) {
        // Close the first statement before proceeding
        $stmt->close();

        // Set a JavaScript variable to confirm the deletion
        echo "<script>
            var userConfirmed = confirm('Are you sure you want to delete the file: $fileName?');
            if (userConfirmed) {
                window.location.href = 'delete_file.php?id=$id';
            } else {
                alert('File deletion canceled.');
                window.location.href = 'admin_docs.php';
            }
        </script>";
    } else {
        echo "Document not found.";
    }
} else {
    echo "Document ID parameter is missing.";
}
?>
