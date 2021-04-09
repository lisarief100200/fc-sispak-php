<?php include('partials/header-admin.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Beranda</h1>
        <br>

        <?php
            if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
            }
        ?>

        <br>
    </div>
</div>

<?php include('partials/footer-admin.php'); ?>