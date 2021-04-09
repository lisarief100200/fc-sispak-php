<?php include('partials/header-admin.php'); ?>

<?php

    $sql = "SELECT max(id) as maxID FROM tbl_penyakit";
        
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($res);

    $kode = $row['maxID'];

    $kode++;
    $ket = "P";
    $kodeauto = $ket . sprintf("%02s", $kode);

?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Tambah Penyakit</h1>
            <br>
        
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>  

            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Penyakit </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kd_penyakit" value="<?php echo $kodeauto; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Penyakit </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nm_penyakit" placeholder="Masukkan Nama Penyakit">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Definisi Penyakit </label>
                    <div class="col-sm-10">
                        <textarea name="definisi" cols="45" rows="5" placeholder=" Definisi Penyakit"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Solusi Penyakit </label>
                    <div class="col-sm-10">
                        <textarea name="solusi" cols="45" rows="5" placeholder=" Solusi Penyakit"></textarea>
                    </div>
                </div>
                
                <br>
                <div class="form-group row">
                    <input id="btn" type="submit" name="submit" value="Tambah Penyakit" class="btn-primary col-sm-3" style="float: right;">
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
        $kd_penyakit = $_POST["kd_penyakit"];
        $nm_penyakit = $_POST["nm_penyakit"];
        $definisi = $_POST["definisi"];
        $solusi = $_POST["solusi"];

        //Step 2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_penyakit SET
            kd_penyakit = '$kd_penyakit',
            nm_penyakit = '$nm_penyakit',
            definisi = '$definisi',
            solusi = '$solusi'
        ";

        //Step 3. Execute Query and save the data in database
        //(in config)

        $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
        //Step 4. Check whether the (Query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //echo "Data inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'> Penyakit Added Successfully. </div>";
            //Redirect Page to Manage Penyakit
            header("location:".SITEURL."admin/manage-penyakit.php");
        }
        else{
            //echo "Failed to insert data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'> Failed to insert data. </div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL."admin/add-penyakit.php");
        }
    }
    else{
        //Button not clicked
        //echo "button not clicked";
    }
?>

<?php include('partials/footer-admin.php'); ?>