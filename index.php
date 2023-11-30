<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: #333;
      overflow: hidden;
    }

    .navbar a {
      float: right;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      margin-right: 30px;
    
    }
   
    .dropdown {
      float: right;
      overflow: hidden;
      margin-right: 30px;

    }

    .dropdown .dropbtn {
      font-size: 16px;
      border: none;
      outline: none;
      color: white;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit;
      margin: 0;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
      background: linear-gradient(to right, #ff105f, #ffad06);
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: black;
      color: black;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      float: none;
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
     
    }

    .dropdown-content a:hover {
      background-color: black;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
    select option {
        color: white;
        background-color: #333;
        border: none;
        outline: none;
        padding: 14px 16px;
        font-size: 16px;
        cursor: pointer;
        margin: 0;
        
    }
  </style>
  <script>
    // JavaScript/jQuery to handle page reload on dropdown selection
    $(document).ready(function () {
      $('.dropdown-content a').on('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior
        var href = $(this).attr('href');
        // Use AJAX to load the content of the selected link
        $.ajax({
          url: href,
          success: function (data) {
            // Update the page content
            $('body').html(data);
          }
        });
      });
    });
  </script>
</head>
<body>

<div class="navbar">
  <a href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <div class="dropdown">
    <select class="dropbtn" name="role" id="role">
        <div class="drodown-content">

        <option value="admin">Admin</option>
        <option value="applicant">Applicant</option>
    </select>
  </div>
  </div>

</div>

<div id="loginFormContainer">
        <!-- Login form will be loaded here -->
        <?php  include 'applicant_form.php';?>
    </div>

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
</body>
</html>
