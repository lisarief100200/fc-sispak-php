<?php 
    include('../config/cons.php');
    include("login-check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <title>Sistem Pakar Diagnosis Penyakit Pada Perokok</title>

    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style-admin.css">

    <!-- Link to bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<head>

<body>
    <!-- Navbar starts here -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ADMIN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Beranda</a>
                <a class="nav-link" href="manage-gejala.php">Gejala</a>
                <a class="nav-link" href="manage-penyakit.php">Penyakit & Solusi</a>
                <a class="nav-link" href="manage-relasi.php">Relasi FC</a>
                <a class="nav-link" href="pasien.php">Pasien</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
            </div>
        </div>
    </nav>
    <!-- Navbar ends here -->