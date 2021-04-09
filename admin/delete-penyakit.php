<?php

    // include cons.php
    include('../config/cons.php');

    // Step 1. Get the kd_penyakit
    $kd_penyakit = $_GET['id'];

    // Step 2. SQL Query
    $sql = "DELETE FROM tbl_penyakit WHERE kd_penyakit='$kd_penyakit'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check query is executed succes or not
    if($res==TRUE){
        $_SESSION['delete']="<div class='success'>Penyakit berhasil dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-penyakit.php');
    }
    else{
        $_SESSION['delete']="<div class='error'>Penyakit gagal dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-penyakit.php');
    }
?>