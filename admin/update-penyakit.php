<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Edit Penyakit</h1>
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
                $kd_penyakit = $_GET['id'];

                // Step 2. SQL Query
                $sql = "SELECT * FROM tbl_penyakit WHERE kd_penyakit='$kd_penyakit'";

                // Step 3. Execute query
                $res = mysqli_query($conn, $sql);

                // Check the query executed or not
                if($res==TRUE){
                    // Check the data is available
                    $count = mysqli_num_rows($res);

                    // Check we have penyakit or not
                    if($count==1){
                        // Get the details
                        $row = mysqli_fetch_assoc($res);

                        $kd_penyakit = $row['kd_penyakit'];
                        $nm_penyakit = $row['nm_penyakit'];
                        $definisi = $row['definisi'];
                        $solusi = $row['solusi'];
                    }
                    else{
                        // Redirect to manage penyakit
                        header('location:'.SITEURL.'admin/manage-penyakit.php');
                    }
                }
            ?>

            <form action="" method="POST">
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Penyakit </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kd_penyakit" value="<?php echo $kd_penyakit; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Penyakit </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nm_penyakit" placeholder="Masukkan Nama Penyakit" value="<?php echo $nm_penyakit; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Definisi Penyakit </label>
                    <div class="col-sm-10">
                        <textarea name="definisi" cols="45" rows="5" placeholder=" Definisi Penyakit" value=""><?php echo $definisi; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Solusi Penyakit </label>
                    <div class="col-sm-10">
                        <textarea name="solusi" cols="45" rows="5" placeholder=" Solusi Penyakit" value=""><?php echo $solusi; ?></textarea>
                    </div>
                </div>
                
                <br>
                <div class="form-group row">
                    <input id="btn" type="submit" name="submit" value="Tambah Penyakit" class="btn-primary col-sm-3">
                </div>
            </form>
        
        </div>
    </div>

<?php

    if(isset($_POST['submit'])){
        //echo "button clicked";

        $kd_penyakit = $_POST['kd_penyakit'];
        $nm_penyakit = $_POST['nm_penyakit'];
        $definisi = $_POST['definisi'];
        $solusi = $_POST['solusi'];

        $sql2 = "UPDATE tbl_penyakit SET
        nm_penyakit = '$nm_penyakit',
        definisi = '$definisi',
        solusi = '$solusi'
        WHERE kd_penyakit = '$kd_penyakit'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res==TRUE){
            $_SESSION['update']="<div class='success'> Penyakit berhasil diedit. </div>";
        
            header("location:".SITEURL."admin/manage-penyakit.php");
        }
        else{
            $_SESSION['update']="<div class='error'> Penyakit gagal diedit. </div>";
        
            header("location:".SITEURL."admin/update-penyakit.php");
        }
    }
    else{
    }

?>

<?php include('partials/footer-admin.php'); ?>