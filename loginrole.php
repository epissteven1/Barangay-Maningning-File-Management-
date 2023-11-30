<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#role").change(function() {
                var selectedRole = $(this).val();

                // Use AJAX to load the corresponding login form
                $.ajax({
                    type: "POST",
                    url: "load_login_form.php",
                    data: { role: selectedRole },
                    success: function(response) {
                        $("#loginFormContainer").html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>

<form method="post" action="admin_form.php">
    <label for="role"></label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="applicant">Applicant</option>
    </select>
    <br>

    <div id="loginFormContainer">
        <!-- Login form will be loaded here -->
    </div>
</form>

</body>
</html>
