<?php
include 'connection.php';
session_start();

if (isset($_GET['id'])) {
    $applicantId = $_GET['id'];
    

    // Fetch applicant details from the database
    $query = "SELECT * FROM applicants WHERE applicant_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $applicantId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $applicant = $result->fetch_assoc();
    } else {
        // Redirect to the main page if the applicant is not found
        header("Location: admin_dashboard.php");
        exit();
    }
} else {
    // Redirect to the main page if the id parameter is not set
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $newFullname = $_POST['fullname'];
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    $updateQuery = "UPDATE applicants SET fullname=?, username=?, email=? WHERE applicant_id=?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('sssi', $newFullname, $newUsername, $newEmail, $applicantId);
    $updateStmt->execute();

    // Redirect to the main page after updating
    header("Location: admin_index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Edit Applicant</title>
</head>
<body>
    <div class="container">
        <h2>Edit Applicant</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="fullname">Fullname:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($applicant['fullname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($applicant['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($applicant['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php var_dump("submit");  ?>
        </form>
    </div>

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
