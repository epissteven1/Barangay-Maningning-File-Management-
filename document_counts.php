<?php
function getTotalDocumentCount($conn) {
    $query = "SELECT COUNT(*) as count FROM documents";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
?>