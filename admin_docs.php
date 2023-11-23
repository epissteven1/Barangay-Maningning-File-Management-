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
    }

    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = array("pdf", "doc", "docx", "txt");

    if (!in_array($fileType, $allowedExtensions)) {
        echo "<script>alert('Sorry, only PDF, DOC, DOCX, and TXT files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Check if the file already exists in the database
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $checkDuplicateQuery = "SELECT * FROM documents WHERE file_uploads ='$fileName'";
    $resultDuplicate = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($resultDuplicate) > 0) {
        echo "<script>alert('Sorry, the file already exists.');</script>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your document was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // Insert information into the documents table
            $sql = "INSERT INTO documents (file_uploads, upload_date) VALUES ('$fileName', NOW())";
            if (mysqli_query($conn, $sql)) {
                // Log the activity
                $logMessage = "File uploaded: $fileName";
                logActivity($conn, $logMessage);
    
                echo "<script>alert('File information inserted into the database.');</script>";
                header('Location: success.php');
                exit();
            } else {
                echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>

<?php
// Retrieve the document information from the database
$sql = "SELECT * FROM documents";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            color: #333333;
        }
        form {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #cccccc;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #a2ada2;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color:#a2ada2;
            color: #6b6987d1;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        button {
            background-color: #696f6e;
            color: lightblue;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            cursor: pointer;
        }
        button.delete {
    background-color: #ff0000;
    color: #ffffff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

button.delete:hover {
    background-color: #cc0000;
}
        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h1>Upload a Document</h1>
    <form action="admin_docs.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <input type="submit" value="Upload Document" name="submit">
    </form> 

    <h2>List of Documents</h2>
    <table>
        <tr>
            <th>File Name</th>
            <th>Upload Date</th>
            <th>Action</th>
        </tr>
        <?php
// Display the document information in the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['file_uploads'] . "</td>";
    echo "<td>" . $row['upload_date'] . "</td>";
    echo "<td>";
    echo "<button onclick='editDocument(" . $row['file_id'] . ")'>Edit</button>";
    echo "<button class='delete' onclick=\"deleteDocument(" . $row['file_id'] . ")\">Delete</button>";
    echo "</td>";
    echo "</tr>";
}
?>
</table>

    <script>
// Function to handle the "Edit" button click
function editDocument(id) {
    // Redirect to the edit document page with the document ID as a parameter
    window.location.href = "update.php?id=" + id;
}

// Function to handle the "Delete" button click
function deleteDocument(id) {
    window.location.href = "delete.php?id=" +id;
}
</script>
</body>
</html>