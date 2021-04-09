<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>List Pasien</h1>

            <table class="table table-bordered table-dark">

                <tr>
                    <th scope="col" class="align-middle">No.</th>
                    <th scope="col" class="align-middle">Kode Pasien</th>
                    <th scope="col" class="align-middle">Jenis Kelamin</th>
                    <th scope="col" class="align-middle">Alamat</th>
                    <th scope="col" class="align-middle">Pekerjaan</th>
                    <th scope="col" class="align-middle">Kode Penyakit</th>
                    <th scope="col" class="align-middle">Tanggal</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_pasien";

                    // Execute query
                    $res = mysqli_query($conn, $sql);

                    // Count rows
                    $count = mysqli_num_rows($res);

                    //Create serial number var and assign as 1
                    $sn = 1;

                    // Check we have in db or not
                    if($count>0){
                        // Data ada
                            while($row=mysqli_fetch_assoc($res)){
                                $nama = $row['nama'];
                                $jenis_kelamin = $row['jenis_kelamin'];
                                $alamat = $row['alamat'];
                                $pekerjaan = $row['pekerjaan'];
                                $kd_penyakit = $row['kd_penyakit'];
                                $tanggal = $row['tanggal'];
                                ?>

                                <tr>
                                    <td class="align-middle"><?php echo $sn++; ?></td>
                                    <td class="align-middle"><?php echo $nama; ?></td>
                                    <td class="align-middle"><?php echo $jenis_kelamin; ?></td>
                                    <td class="align-middle"><?php echo $alamat; ?></td>
                                    <td class="align-middle"><?php echo $pekerjaan; ?></td>
                                    <td class="align-middle"><?php
                                    
                                        if($kd_penyakit==""){
                                            echo "Tidak Terdeteksi";
                                        }
                                        else{
                                            echo $kd_penyakit;
                                        }

                                    ?></td>
                                    <td class="align-middle"><?php echo $tanggal; ?></td>
                                </tr>
    
                                <?php
                            }
                        
                    }
                    else{
                        // Ga ada data
                        ?>
                        <tr>
                            <td colspan="4"><div class="error"> Relasi kosong.</div></td>
                        </tr>
                        <?php
                    }
                ?>

            </table>

        </div>
    </div>

<?php include('partials/footer-admin.php'); ?>