



<?php
 include 'connection.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    // User is not authenticated, redirect to a login page
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Styling for the modal container */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.5);
            width: 300px;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        /* Styling for the modal content */
        .modal-content {
            background-color: blue;
            padding: 20px;
        }

        /* Styling for the close button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Button to open the modal -->
<button onclick="openModal()">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Document Upload</h2>
        <f<form id="fileUploadForm" enctype="multipart/form-data" action="upload_handler.php" method="post">
            <input type="file" id="fileInput" name="file" accept=".pdf, .doc, .docx">
            <button type="button" onclick="uploadFile()">Upload File</button>
       
        </form>
        <div id="fileInfo" style="display: none;">
            <p>File Name: <span id="fileName"></span></p>
            <p>File Type: <span id="fileType"></span></p>
            <p>File Size: <span id="fileSize"></span> bytes</p>
        </div>
    </div>
</div>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    function uploadFile() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];

        if (file) {
            // Perform any necessary file upload operations here

            // Redirect to the admin_upload.php page after file upload
            window.location.href = 'admin_index.php';
        } else {
            alert('Please select a file to upload.');
        }
    }
</script>

</body>
</html>
