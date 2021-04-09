<?php

    // include cons.php
    include('../config/cons.php');

    // Step 1. Get the nm_gejala
    $nm_penyakit = $_GET['id'];

    // Step 2. SQL Query
    $sql = "DELETE FROM tbl_relasi WHERE nm_penyakit='$nm_penyakit'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check query is executed succes or not
    if($res==TRUE){
        $_SESSION['delete']="<div class='success'>Relasi berhasil dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-relasi.php');
    }
    else{
        $_SESSION['delete']="<div class='error'>Relasi gagal dihapus</div>";
    
        header('location:'.SITEURL.'admin/manage-relasi.php');
    }
?>