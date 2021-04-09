<?php 

    // Authorization -- Access Control
    // Check the user is log in or not
    if(!isset($_SESSION['user'])){ // If user session is not set
        // User is not log in
        // Redirect to login page with msg
        $_SESSION['no-login-msg']="<div class='error'> Silahkan login untuk mengakses halaman Admin.</div>";
    
        // Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }

?>