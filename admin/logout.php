<?php
    // Include constansts for SITEURL
    include('../config/cons.php');

    // Step 1. Destroy the Session
    session_destroy(); // Unsets $_SESSION['user'];

    // Step 2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>