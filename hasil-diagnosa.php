<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Halaman Hasil</h1>
            <br>

            <?php
            
                // Step 1. Get ID
                $kd_penyakit = $_GET['id'];

                // Step 2. Get details
                $sql = "SELECT * FROM tbl_penyakit WHERE kd_penyakit='$kd_penyakit'";

                $res = mysqli_query($conn, $sql);

                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);

                        $kd_penyakit = $row['kd_penyakit'];
                        $nm_penyakit = $row['nm_penyakit'];
                        $definisi = $row['definisi'];
                        $solusi = $row['solusi'];
                        $i = 0;
                    }
                    else{
                        // Redirect to penyakit-not-found
                        header('location:'.SITEURL.'penyakit-not-found.php');
                    }
                }
                else{
                    printf("Error: %s\n", mysqli_error($conn));
                    exit();
                }

            ?>

            <table class="table table-bordered table-dark">
                <tr>
                    <td colspan="2"><b>Hasil Diagnosa Penyakit</b></td>
                </tr>

                <tr>
                    <td>Penyakit</td>
                    <td class="error"><?php echo $nm_penyakit; ?></td>
                </tr>

                <tr>
                    <td valign="top">Gejala</td>
                    <td>
                        <?php

                        $sql2 = "SELECT tbl_gejala.* FROM tbl_gejala, tbl_relasi WHERE tbl_gejala.nm_gejala = tbl_relasi.nm_gejala
                        AND tbl_relasi.nm_penyakit='$nm_penyakit' ORDER BY tbl_gejala.nm_gejala";
                        $res2 = mysqli_query($conn, $sql2);
                        
                        if (!$res2) {
                            printf("Error: %s\n", mysqli_error($conn));
                            exit();
                        }

                        while($row2=mysqli_fetch_array($res2)){
                            $i++;
                            echo "$i. $row2[nm_gejala] <br>";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Definisi</td>
                    <td><?php echo $definisi; ?></td>
                </tr>

                <tr>
                    <td>Solusi</td>
                    <td><?php echo $solusi; ?></td>
                </tr>
            </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>