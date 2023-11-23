<?php
$server = "localhost";
$username = "root"; 
$password = "";
$database = "file_management";  // Replace with your database name

// Create a connection to the database
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (if needed)
$conn->set_charset("utf8");

// Optionally, you can define other configuration settings for your database connection here.

?>