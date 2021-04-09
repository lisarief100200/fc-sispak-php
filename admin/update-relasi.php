<?php include('partials/header-admin.php'); ?>

    <!-- MASIH FORM BIASA huhu -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Edit Relasi</h1>
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
                $nm_penyakit = $_GET['id'];

                // Step 2. SQL Query
                $sql = "DELETE FROM tbl_relasi WHERE nm_penyakit='$nm_penyakit'";

                // Step 3. Execute query
                $res = mysqli_query($conn, $sql);

                if (!$res) {
                    printf("Error: %s\n", mysqli_error($conn));
                    exit();
                }

                // Check the query executed or not
                if($res==TRUE){
                    // Check the data is available
                    $count = mysqli_num_rows($res);

                    // Check we have relasi or not
                    if($count==1){
                        // Get the details
                        $row = mysqli_fetch_assoc($res);

                        $nm_penyakit = $row['nm_penyakit'];
                        $nm_gejala = $row['nm_gejala'];
                    }
                    else{
                        // Redirect to manage relasi
                        header('location:'.SITEURL.'admin/manage-relasi.php');
                    }
                }
            ?>

            <form action="" method="POST">
            <div class="form-group">
                    <label class="col-sm-2 col-form-label" style="font-size:18px">Daftar Penyakit </label>
                    <div class="col-sm-10">
                        <select name="nm_penyakit">

                            <?php

                                $sql = "SELECT * FROM tbl_penyakit ORDER BY kd_penyakit";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $kd_penyakit = $row['kd_penyakit'];
                                        $nm_penyakit = $row['nm_penyakit'];

                                        ?>

                                        <option value="<?php echo $nm_penyakit;?>"><?php echo $kd_penyakit;?> | <?php echo $nm_penyakit; ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    ?>

                                    <option value="0"> No Penyakit Found</option>

                                    <?php
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label" style="font-size:18px">Daftar Gejala </label>
                    <div class="col-sm-10">
                        <select name="nm_gejala">

                            <?php

                                $sql = "SELECT * FROM tbl_gejala ORDER BY kd_gejala";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $kd_gejala = $row['kd_gejala'];
                                        $nm_gejala = $row['nm_gejala'];

                                        ?>

                                        <option value="<?php echo $nm_gejala;?>"><?php echo $kd_gejala;?> | <?php echo $nm_gejala; ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    ?>

                                    <option value="0"> No Gejala Found</option>

                                    <?php
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <br>
                <div class="form-group row">
                    <input id="btn" type="submit" name="submit" value="Tambah Relasi" class="btn-primary col-sm-3">
                </div>
            </form>
        
        </div>
    </div>

<?php

    if(isset($_POST['submit'])){
        //echo "button clicked";

        $nm_penyakit = $_POST['nm_penyakit'];
        $nm_gejala = $_POST['nm_gejala'];

        $sql2 = "UPDATE tbl_relasi SET
        nm_gejala = '$nm_gejala'
        WHERE nm_penyakit = '$nm_penyakit'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res==TRUE){
            $_SESSION['update']="<div class='success'> Relasi berhasil diedit. </div>";
        
            header("location:".SITEURL."admin/manage-relasi.php");
        }
        else{
            $_SESSION['update']="<div class='error'> Relasi gagal diedit. </div>";
        
            header("location:".SITEURL."admin/update-relasi.php");
        }
    }
    else{
    }

?>

<?php include('partials/footer-admin.php'); ?>