    <?php
    // Include your database connection file
    include 'connection.php';

    // Assuming you have sanitized and validated the input for security
    $request_id = $_GET['request_id']; // You might want to use $_POST depending on your implementation

    // Update the document request status to 'Accepted' and update the message
    $updateQuery = "UPDATE permission_requests
                    SET status = 'Accepted'
                    WHERE request_id = ?";

    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "i", $request_id);
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        // Update the message in the permission_messages table
        echo 'Request ID: ' . $request_id;
        $updateMessageQuery = "UPDATE permission_messages
                            SET message = 'Your permission request has been accepted. You can now download the file.'
                            WHERE request_id = ?";

        $stmtMessage = mysqli_prepare($conn, $updateMessageQuery);
        mysqli_stmt_bind_param($stmtMessage, "i", $request_id);
        $updateMessageResult = mysqli_stmt_execute($stmtMessage);

        var_dump($updateMessageQuery, $stmtMessage, $updateMessageResult, mysqli_error($conn));


        if ($updateMessageResult) {
            // Optionally, you can redirect the user to a success page
            header("Location: success.php");
            exit();
        } else {
            echo 'Error updating acceptance message: ' . mysqli_error($conn);
        }

        // Close the message statement
        mysqli_stmt_close($stmtMessage);
    } else {
        echo 'Error accepting document request: ' . mysqli_error($conn);
    }

    // Close the request statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
    ?>
