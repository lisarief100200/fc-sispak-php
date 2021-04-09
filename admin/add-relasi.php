<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Tambah Relasi</h1>
            <br>
        
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <br>
            <form action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 col-form-label" style="font-size:18px">Daftar Penyakit </label>
                    <div class="col-sm-10">
                        <select name="nm_penyakit">

                            <?php

                                $sql = "SELECT * FROM tbl_penyakit ORDER BY kd_penyakit";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                ?>
                                <option value="" selected disabled> Pilih Penyakit</option>
                                <?php

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

                                ?>

                                <option value="" selected disabled> Pilih Gejala</option>

                                <?php
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
    //Process the form value and save it to database
    //Check whether the submit is clicked or not

    if(isset($_POST["submit"])){
        //Button clicked
        //echo "button clicked";

        //Step 1. Get the data from form
        $nm_penyakit = $_POST["nm_penyakit"];
        $nm_gejala = $_POST["nm_gejala"];

        //Step 2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_relasi SET
            nm_penyakit = '$nm_penyakit',
            nm_gejala = '$nm_gejala'
        ";

        //Step 3. Execute Query and save the data in database
        //(in config)

        $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
        //Step 4. Check whether the (Query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //echo "Data inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'> Relasi Added Successfully. </div>";
            //Redirect Page to Manage Relasi
            header("location:".SITEURL."admin/manage-relasi.php");
        }
        else{
            //echo "Failed to insert data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'> Failed to insert data. </div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL."admin/add-relasi.php");
        }
    }
    else{
        //Button not clicked
        //echo "button not clicked";
    }
?>

<?php include('partials/footer-admin.php'); ?>