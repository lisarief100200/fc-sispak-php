<?php include("../config/cons.php")?>

<html>
    <head>
        <title>Sistem Pakar Diagnosa Penyakit Anak Balita</title>
        <link rel="stylesheet" href="css/style-admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <img class="img-center" src="../images/logo.png" alt="" width="120" height="150">

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-msg'])){
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
            ?>
            <br><br>
            
            <!-- Login starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!-- Login ends here -->
            <br>
            <p class="text-center">Created with ❤️ by Lisa Arief</p>
        </div>
    </body>
</html>

<?php 
    // Check submit btn is clicked or not
    if(isset($_POST['submit'])){
        // Process for login
        // Step 1. Get the data from login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Step 2. SQL check the user with username and password exist or nah
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // Step 3. Execute the query
        $res = mysqli_query($conn, $sql);

        // Step 4. Count rows to check the user exist or not
        $count = mysqli_num_rows($res);

        if($count==1){
            // User available and login succes
            $_SESSION['login']="<div class='success'> Login Successful.</div>";

            $_SESSION['user']=$username; // to check whether the user is logged in or not and log out will unset it

            // Redirect to home page/ dashboard
            header('location:'.SITEURL.'admin/');
        }
        else{
            // User not available, login failed
            $_SESSION['login']="<div class='error text-center'> Username or Password not match.</div>";

            // Redirect to home page/ dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>