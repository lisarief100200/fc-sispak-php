<?php

    // include cons.php
    include('../config/cons.php');

    // Step 1. Get the kd_gejala
    $kd_gejala = $_GET['id'];

    // Step 2. SQL Query
    $sql = "DELETE FROM tbl_gejala WHERE kd_gejala='$kd_gejala'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check query is executed succes or not
    if($res==TRUE){
        $_SESSION['delete']="<div class='success'>Gejala berhasil dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-gejala.php');
    }
    else{
        $_SESSION['delete']="<div class='error'>Gejala gagal dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-gejala.php');
    }
?>