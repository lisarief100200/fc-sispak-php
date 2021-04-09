<?php

    //Start session
    ob_start();
    session_start();

    //Create constansts to store non repetiang values
    define("SITEURL", "http://localhost/fc-lisa/");
    define("LOCALHOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "db_fc");

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Database selection
?>