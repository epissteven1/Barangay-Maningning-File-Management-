<?php
include 'connection.php';

$response = array();

if (isset($_GET['id'])) {
    $applicantId = $_GET['id'];

    // Fetch applicant details from the database
    $query = "SELECT * FROM applicants WHERE applicant_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $applicantId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response['success'] = true;
        $response['applicant'] = $result->fetch_assoc();
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>