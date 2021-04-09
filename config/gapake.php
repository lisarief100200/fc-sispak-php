<?php
    $tabel = "tbl_gejala";
    $inisial = "G";

    $sql = "SELECT * FROM $tabel";

    $res = mysqli_query($conn, $sql);

    $field = 4;

    $panjang = 4;

    $sql2 = "SELECT max(4) FROM $tabel";

    $res2 = mysqli_query($conn, $sql2);

    $row = mysqli_fetch_array($res2);
    if ($row[0]=="") {
        $angka=0;
    }
    else {
        $angka = substr($row[0], strlen($inisial));
    }

    $angka++;
	$angka =strval($angka);
	$tmp ="";
	for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
	}
    echo $inisial.$tmp.$angka;
    ?>


<?php // UNTUK DIAGNOSA ALL ?>
<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Diagnosa</h1>
            <br>
            
            <?php 
                if(isset($_SESSION['no-add'])){
                    echo $_SESSION['no-add'];
                    unset($_SESSION['no-add']);
                }
            ?>

            <br>

            <form action="" method="POST">
            
                <?php

                $sql = "SELECT * FROM tbl_gejala";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0){
                    // Diagnosa ada
                    while($row=mysqli_fetch_assoc($res)){
                        echo "<input type='checkbox' value='".$row['kd_gejala']."' name='kd_gejala[]' /> ".$row['nm_gejala']."<br>";
                    ?>
                    <br>

                    <?php
                    }
                }
                else{
                    // Diagnosa belum ada
                    ?>
                    <p><div class="error"> Diagnosa masih kosong.</div></p>
                    <?php
                }

                ?>
                
                <input id="btn" type="submit" name="submit" value="Cek Diagnosa" class="btn-primary col-sm-3">
            </form>

            <?php

                if(isset($_POST['submit'])){
                    //echo "button clicked";
                    $kd_gejala = $_POST['kd_gejala'];
                    $jumlah_gejala = count($kd_gejala);

                    // Masih error, nanti diperbaiki
                    if($jumlah_gejala==0){
                        $_SESSION['no-add'] = "<div class='error'> Tidak ada gejala yang dipilih. </div>";
                        //Redirect Page to Manage Gejala
                        header("location:".SITEURL."diagnosa.php");
                    }
                    else{
                        #echo "Code $jumlah_gejala";
                        #echo print_r($kd_gejala);
                        $sql2 = "SELECT * FROM tbl_relasi WHERE kd_gejala IN (";
                            
                            for($x = 0; $x < $jumlah_gejala; $x++){
                                $sql2 .= "'".$kd_gejala[$x]."', ";
                            }

                            $sql2 = rtrim($sql2, ', ');
                            $sql2 = $sql2.")";

                            // Dibandingkan antara total yang dipilih dengan total gejala yang ada di penyakit
                            $sql3 = "SELECT a.kd_penyakit, a.nm_penyakit, count(a.kd_gejala) AS gejala_A, count(b.kd_gejala) AS gejala_B FROM (
                                SELECT a.nm_penyakit, a.kd_gejala, b.kd_penyakit FROM tbl_relasi a left join tbl_penyakit b on a.nm_penyakit = b.nm_penyakit
                                )a
                                LEFT JOIN(
                                    $sql2
                                    )B
                                    ON a.nm_penyakit = b.nm_penyakit AND a.kd_gejala = b.kd_gejala
                                    GROUP BY a.nm_penyakit, a.kd_penyakit
                                    HAVING count(a.kd_gejala) = count(b.kd_gejala)";
                                    //echo $sql3;

                                    ?>

                                    <?php

                                    ?>

                                    <?php

                                    $res2 = mysqli_query($conn, $sql3);
                                    //$row2 = mysqli_fetch_assoc($res2);
                                    $count = mysqli_num_rows($res2);
                                    $kd_gejala = $row2['gejala_A'];

                                    if($count == 0 OR $x != $kd_gejala){
                                        echo "<script>alert('Penyakit tidak ditemukan\\nSilahkan ulangi pencarian gejala :)')</script>";
                                    }
                                    else{
                                        //echo "<script>alert('Diagnosa Penyakit ".$row2['nm_penyakit']." ditemukan..!\\nSilahkan cek tabel hasil diagnosa dibawah')</script>";
                                        echo "Penyakit ditemukan";
                                    }

                    }
                }

            ?>
        </div>
    </div>

<?php include('partials/footer.php')?>


<?php // MAU COBA AUTO INCREMENT + CHARA ?>

<?php include('partials/header-admin.php'); ?>

<?php

    $sql = "SELECT * FROM tbl_gejala ORDER BY kd_gejala DESC LIMIT 1";
    
    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($res);

    $last_kd = $row['kd_gejala'];

    if($last_kd == ""){
        $kd_gej = "G1";
    }
    else{
        $kd_gej = substr($last_kd, 1);
        $kd_gej = intval($kd_gej);
        $kd_gej = "G" . ($kd_gej + 1);
    }

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
                    <input type="text" class="form-control" name="kd_gejala" value="<?php echo $kd_gej; ?>" readonly>
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
    //tes
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

<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>
<?php // COBA ISI DATA DIRI SEBELUM DIAGNOSA ?>

<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Halaman Diagnosa</h1>
            <br>
            
            <?php 
                if(isset($_SESSION['no-add'])){
                    echo $_SESSION['no-add'];
                    unset($_SESSION['no-add']);
                }
            ?>

            <br>

            <form action="" method="POST">

                <div class="data-diri">
                
                    <h5><b>Data Diri</b></h5>
                    <p><b>Mohon isi data diri yang tertera di bawah ini.</b></p>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            Nama Lengkap:
                        </label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </div>

                    <br>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            Jenis Kelamin:
                        </label>
                        
                        <div class="col-sm-10">
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki">
                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    
                        </div>
                    </div>

                    <br>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            Alamat:
                        </label>
                        
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="alamat" cols="45" rows="5"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            Pekerjaan:
                        </label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pekerjaan">
                        </div>
                    </div>

                    <br>

                </div>
            
                <br>

                <h5>Pilih gejala-gejala yang Anda rasakan di bawah ini!</h5>
                <br>

                <?php

                $sql = "SELECT * FROM tbl_gejala";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0){
                    // Diagnosa ada
                    while($row=mysqli_fetch_assoc($res)){
                        echo "<input type='checkbox' value='".$row['nm_gejala']."' name='nm_gejala[]' /> ".$row['nm_gejala']."<br>";
                    ?>
                    <br>

                    <?php
                    }
                }
                else{
                    // Diagnosa belum ada
                    ?>
                    <p><div class="error"> Diagnosa masih kosong.</div></p>
                    <?php
                }

                ?>
                
                <input id="btn" type="submit" name="submit" value="Cek Diagnosa" class="btn-primary col-sm-3">
            </form>

            <?php

                if(isset($_POST['submit'])){
                    //echo "button clicked";
                    $nm_gejala = $_POST['nm_gejala'];
                    $jumlah_gejala = count($nm_gejala);

                    // Masih error, nanti diperbaiki
                    if($jumlah_gejala==0){
                        $_SESSION['no-add'] = "<div class='error'> Tidak ada gejala yang dipilih. </div>";
                        //Redirect Page to Manage Gejala
                        header("location:".SITEURL."diagnosa.php");
                    }
                    else{
                        #echo "Code $jumlah_gejala";
                        #echo print_r($kd_gejala);
                        $sql2 = "SELECT * FROM tbl_relasi WHERE nm_gejala IN (";
                        for($x = 0; $x < $jumlah_gejala; $x++){
                            $sql2 .= "'".$nm_gejala[$x]."', ";
                        }
                        
                        $sql2 = rtrim($sql2, ', ');
                        $sql2 = $sql2.")";
     
                        //dibandingkan antara total yang diceklist dengan total gejala yang ada dipenyakit tersebut
                        $sql3 = "SELECT a.kd_penyakit, a.nm_penyakit, count(a.nm_gejala) AS gejala_A, count(b.nm_gejala) AS gejala_B FROM (
                            SELECT a.nm_penyakit, a.nm_gejala, b.kd_penyakit FROM tbl_relasi a LEFT JOIN tbl_penyakit b ON a.nm_penyakit = b.nm_penyakit
                            )a
                            LEFT JOIN (
                            $sql2
                            )B
                            ON a.nm_penyakit = b.nm_penyakit AND a.nm_gejala = b.nm_gejala
                            GROUP BY a.nm_penyakit, a.kd_penyakit
                            HAVING count(a.nm_gejala) = count(b.nm_gejala)";
                            //echo $sql3;
                            //echo print_r($nm_gejala);

                            $res2 = mysqli_query($conn, $sql3);
                            if (!$res2) {
                                printf("Error: %s\n", mysqli_error($conn));
                                exit();
                            }
                            $row2 = mysqli_fetch_assoc($res2);
                            $count = mysqli_num_rows($res2);
                            $nm_gejala = $row2['gejala_A'];

                            //echo $nm_gejala;
                            //echo $row2;

                            $id = $row2['kd_penyakit'];

                            header("location:".SITEURL."hasil-diagnosa.php?id=".$id);
                            //if($count == 0 OR $x != $nm_gejala){
                                //Redirect Page to Manage Gejala
                                
                            //}
                            //else{
                                //echo "<script>alert('Diagnosa Penyakit ".$row2['nm_penyakit']." ditemukan..!\\nSilahkan cek tabel hasil diagnosa dibawah')</script>";
                                //Redirect Page to Manage Gejala
                                //header("location:".SITEURL."hasil-diagnosa.php?id=".$id);
                            //}

                    }
                }

            ?>
        </div>
    </div>

<?php include('partials/footer.php')?>