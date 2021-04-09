<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Kelola Penyakit & Solusi</h1>
            <br>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <br>
            <!-- Button to Add penyakit -->
            <a href="<?php echo SITEURL; ?>admin/add-penyakit.php" class="button-add">+ Tambah Penyakit</a>
            <br>
            <br>

            <table class="table table-bordered table-dark">
                <tr>
                    <th scope="col" class="align-middle">No.</th>
                    <th scope="col" class="align-middle">Kode Penyakit</th>
                    <th scope="col" class="align-middle">Nama Penyakit</th>
                    <th scope="col" class="align-middle">Definisi</th>
                    <th scope="col" class="align-middle">Solusi</th>
                    <th scope="col" colspan="2" class="align-middle">Actions</th>
                </tr>

                <?php
                    // Query to get all penyakit from database
                    $sql = "SELECT * FROM tbl_penyakit";

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
                                $kd_penyakit = $row['kd_penyakit'];
                                $nm_penyakit = $row['nm_penyakit'];
                                $definisi = $row['definisi'];
                                $solusi = $row['solusi'];
                                $id = $row['kd_penyakit'];
                                ?>

                                <tr>
                                    <td class="align-middle"><?php echo $sn++; ?></td>
                                    <td class="align-middle"><?php echo $kd_penyakit; ?></td>
                                    <td class="align-middle"><?php echo $nm_penyakit; ?></td>
                                    <td class="align-middle"><?php echo $definisi; ?></td>
                                    <td class="align-middle"><?php echo $solusi; ?></td>
                                    <td class="align-middle">
                                        <a href="<?php echo SITEURL; ?>admin/update-penyakit.php?id=<?php echo $id; ?>" class="button-update align-middle">Edit</a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?php echo SITEURL; ?>admin/delete-penyakit.php?id=<?php echo $id; ?>" class="button-delete align-middle">Delete</a>
                                    </td>
                                </tr>
    
                                <?php
                            }
                        
                    }
                    else{
                        // Ga ada data
                        ?>
                        <tr>
                            <td colspan="6"><div class="error"> Penyakit kosong.</div></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>

<?php include('partials/footer-admin.php'); ?>