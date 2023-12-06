<?php

include 'includes/session_app.php';


function getTotalDocumentCount($conn) {
    $query = "SELECT COUNT(*) as count FROM documents";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
function getTotalApplicantCount($conn) {
    $query = "SELECT COUNT(*) as count FROM applicants";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
  

function getTotalRequestDocumentCount($conn, $id) {
    $query = "SELECT COUNT(*) as count FROM permission_requests WHERE applicant_id = ?";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $row['count'];
}


?>