<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="user_styles/pass.css">

<head>

</head>
<body>
<div class="overlay" id="overlay"></div>
    <div class="modal" id="myModal">
    <div class="register-container">
        <h2>Change Password</h2>
        <?php
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        } elseif (isset($success_message)) {
            echo '<p style="color: green;">' . $success_message . '</p>';
        }
        ?>
        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="change_password" class="change-password">Change Password</button>
                <button type="button" onclick="closeModal()" class="cancel">Cancel</button>
            </div>
            <div class="form-group">

            </div>
        </form>
    </div>
    </div>
    <button onclick="openModal()">Open</button>
    <script>
        // JavaScript to open and close the modal
        function openModal() {
            document.getElementById('myModal').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            setTimeout(function() {
                document.getElementById('myModal').style.opacity = '1';
                document.getElementById('overlay').style.opacity = '1';
            }, 50);
        }

        function closeModal() {
            document.getElementById('myModal').style.opacity = '0';
            document.getElementById('overlay').style.opacity = '0';
            setTimeout(function() {
                document.getElementById('myModal').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }, 300);
        }

        // Close the modal if the overlay is clicked
        document.getElementById('overlay').addEventListener('click', function () {
            closeModal();
        });
    </script>
</body>
</html>
