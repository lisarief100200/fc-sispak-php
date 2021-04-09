<?php include('partials/header-admin.php'); ?>

<?php

    $sql = "SELECT max(id) as maxID FROM tbl_gejala";
    
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($res);

    $kode = $row['maxID'];

    $kode++;
    $ket = "G";
    $kodeauto = $ket . sprintf("%02s", $kode);

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Tambah Gejala</h1>
        <br>
        
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br>
        <form action="" method="POST">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Gejala </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kd_gejala" value="<?php echo $kodeauto; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Gejala </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nm_gejala" placeholder="Masukkan Nama Gejala">
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
    //Process the form value and save it to database
    //Check whether the submit is clicked or not

    if(isset($_POST["submit"])){
        //Button clicked
        //echo "button clicked";

        //Step 1. Get the data from form
        $kd_gejala = $_POST["kd_gejala"];
        $nm_gejala = $_POST["nm_gejala"];

        //Step 2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_gejala SET
            kd_gejala = '$kd_gejala',
            nm_gejala = '$nm_gejala'
        ";

        //Step 3. Execute Query and save the data in database
        //(in config)

        $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
        //Step 4. Check whether the (Query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //echo "Data inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'> Gejala Added Successfully. </div>";
            //Redirect Page to Manage Gejala
            header("location:".SITEURL."admin/manage-gejala.php");
        }
        else{
            //echo "Failed to insert data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'> Failed to insert data. </div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL."admin/add-gejala.php");
        }
    }
    else{
        //Button not clicked
        //echo "button not clicked";
    }
?>

<?php include('partials/footer-admin.php'); ?>