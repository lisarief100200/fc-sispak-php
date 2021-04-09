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

        <div class="row">
            <div class="col dashboard text-center">
                <?php

                    $sql = "SELECT * FROM tbl_penyakit";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                ?>

                <h1><?php echo $count; ?></h1>
                <br>
                Penyakit
            </div>
            
            <div class="col dashboard text-center">
                <?php

                    $sql2 = "SELECT * FROM tbl_gejala";

                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);

                ?>

                <h1><?php echo $count2; ?></h1>
                <br>
                Gejala
            </div>

            <div class="col dashboard text-center">
                <?php

                    $sql3 = "SELECT * FROM tbl_relasi";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);

                ?>

                <h1><?php echo $count3; ?></h1>
                <br>
                Relasi
            </div>

            <div class="col dashboard text-center">
                <?php

                    $sql4 = "SELECT * FROM tbl_pasien";

                    $res4 = mysqli_query($conn, $sql4);

                    $count4 = mysqli_num_rows($res4);

                ?>
                <h1><?php echo $count4; ?></h1>
                <br>
                Pasien
            </div>
        </div>


    </div>
</div>

<?php include('partials/footer-admin.php'); ?>