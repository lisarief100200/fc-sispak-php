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

                    $nama = $_POST['nama'];
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                    $alamat = $_POST['alamat'];
                    $pekerjaan = $_POST['pekerjaan'];

                    $tanggal = date("Y-m-d h:i:sa"); // Order date

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

                            $sql4 = "INSERT INTO tbl_pasien SET
                                nama = '$nama',
                                jenis_kelamin = '$jenis_kelamin',
                                alamat = '$alamat',
                                pekerjaan = '$pekerjaan',
                                kd_penyakit = '$id',
                                tanggal = '$tanggal'
                            ";

                            $res3 = mysqli_query($conn, $sql4);

                            if($res2==TRUE){
                                header("location:".SITEURL."hasil-diagnosa.php?id=".$id);
                            }
                            else{
                                header('location:'.SITEURL);
                            }

                            //header("location:".SITEURL."hasil-diagnosa.php?id=".$id);
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