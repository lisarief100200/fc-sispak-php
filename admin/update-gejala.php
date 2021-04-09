<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Edit Gejala</h1>
            <br>

            <?php
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>

            <br>

            <?php
                // Step 1. Get ID
                $kd_gejala = $_GET['id'];

                // Step 2. SQL Query
                $sql = "SELECT * FROM tbl_gejala WHERE kd_gejala='$kd_gejala'";

                // Step 3. Execute query
                $res = mysqli_query($conn, $sql);

                // Check the query executed or not
                if($res==TRUE){
                    // Check the data is available
                    $count = mysqli_num_rows($res);

                    // Check we have gejala or not
                    if($count==1){
                        // Get the details
                        $row = mysqli_fetch_assoc($res);

                        $kd_gejala = $row['kd_gejala'];
                        $nm_gejala = $row['nm_gejala'];
                    }
                    else{
                        // Redirect to manage gejala
                        header('location:'.SITEURL.'admin/manage-gejala.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Gejala </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kd_gejala" value="<?php echo $kd_gejala; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Gejala </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nm_gejala" placeholder="Masukkan Nama Gejala" value="<?php echo $nm_gejala; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <input id="btn" type="submit" name="submit" value="Tambah Gejala" class="btn-primary col-sm-3">
                </div>
            </form>
        
        </div>
    </div>

<?php

    if(isset($_POST['submit'])){
        //echo "button clicked";

        $kd_gejala = $_POST['kd_gejala'];
        $nm_gejala = $_POST['nm_gejala'];

        $sql2 = "UPDATE tbl_gejala SET
        nm_gejala = '$nm_gejala'
        WHERE kd_gejala = '$kd_gejala'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res==TRUE){
            $_SESSION['update']="<div class='success'> Gejala berhasil diedit. </div>";
        
            header("location:".SITEURL."admin/manage-gejala.php");
        }
        else{
            $_SESSION['update']="<div class='error'> Gejala gagal diedit. </div>";
        
            header("location:".SITEURL."admin/update-gejala.php");
        }
    }
    else{
    }

?>

<?php include('partials/footer-admin.php'); ?>