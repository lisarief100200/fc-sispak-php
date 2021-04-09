<?php include('partials/header-admin.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Kelola Relasi FC</h1>
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
            ?>

            <br>
            <!-- Button to Add relasi -->
            <a href="<?php echo SITEURL; ?>admin/add-relasi.php" class="button-add">+ Tambah Relasi</a>
            <br>
            <br>

            <table class="table table-bordered table-dark">
                <tr>
                    <th scope="col" class="align-middle">No.</th>
                    <th scope="col" class="align-middle">Kode Penyakit</th>
                    <th scope="col" class="align-middle">Nama Gejala</th>
                    <th scope="col" class="align-middle">Actions</th>
                </tr>

                <?php
                    // Query to get all relasi from database
                    $sql = "SELECT * FROM tbl_relasi";

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
                                $nm_penyakit = $row['nm_penyakit'];
                                $nm_gejala = $row['nm_gejala'];
                                $id = $row['nm_penyakit']; // Ga tau, harus ID masa
                                ?>

                                <tr>
                                    <td class="align-middle"><?php echo $sn++; ?></td>
                                    <td class="align-middle"><?php echo $nm_penyakit; ?></td>
                                    <td class="align-middle"><?php echo $nm_gejala; ?></td>
                                    <!--
                                    <td class="align-middle">
                                        <a href="<?php echo SITEURL; ?>admin/update-relasi.php?id=<?php echo $id; ?>" class="button-update align-middle">Edit</a>
                                    </td>
                                    -->
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/delete-relasi.php?id=<?php echo $id; ?>" class="button-delete align-middle">Delete</a>
                                    </td>
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