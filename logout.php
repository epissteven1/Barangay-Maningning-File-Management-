<?php
session_start();

if (isset($_POST['logout'])) {
    // Perform logout logic here, such as unsetting the session
    session_unset();
    session_destroy();
    exit();
}
?>