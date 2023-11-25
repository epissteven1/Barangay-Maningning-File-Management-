<?php
session_start();
include_once "connection.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .container {
            height: 100%;
            width: 100%;
            background-image:  linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(background/background2.jpg);
            background-position: center;
            background-size: cover;
            position: absolute;
      
            
        }
        .form-box {
            width: 380px;
            height: 500px;
            position: relative;
            margin: 6% auto;
            background: #fff;
            padding: 5px;
            overflow: hidden;
          
            
        }
        .button-box {
            width: 220px;
            margin: 35px auto;
            position: relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
        }
        .toggle-btn {
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;

        }
        #btn {
            top: 0;
            left: 0;
            position: absolute;
            width: 110px;
            height: 100%;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border-radius: 30px;
            transition: .5s;
        }
          
        .input-group {
            top: 150px;
            position: absolute;
            width: 280px;
            transition: .5s;

        }
        .input-field {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;

        }
        .submit-btn {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            margin-top: 20px;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: 0;
            outline: none;
            border-radius: 30px;

        }
        #login {
            left: 50px;


        }
        #register {
            left: 450px;

        }
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>

            </div>
        
        <form id="login" action="login.php" method="post" class="input-group">
            <input type="text" name="username" class="input-field" placeholder="Username" required>
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <button type="submit" name="login" class="submit-btn">Login</button>
         </form>
         <form  id="register" action="register.php" method="post" class="input-group">
     
                <input  class="input-field" type="text" id="fullname" name="fullname" placeholder="Fullname">
                <input  class="input-field" type="text" id="username" name="username" placeholder="Username" required>
                <input  class="input-field"  type="email" id="email" name="email" placeholder="Email" required>
                <input  class="input-field" type="password" name="password_1" placeholder="Password" required>
                <input  class="input-field" type="password" name="password_2" placeholder="Confirm Password" required>
                <input class="submit-btn" type="submit" name="register" value="Register">
        
         </form>
       </div>
    </div>
    
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");
        function register(){
            
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";     
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";

        }
        function setRole(role) {
        // You can do something with the role, for example, store it in a variable or perform other actions.
        console.log('Selected role:', role);
    }
    </script>
</body>
</html>