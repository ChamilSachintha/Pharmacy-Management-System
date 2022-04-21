<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Pharmacy Management System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h2 class="text-center">Login</h2>
            <br><br>

            <?php
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            ?>

            <br><br>

            <!-- Login form starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login form ends here -->

            <br><br><br>

            <p class="text-center">Created by - <a href="#">Sachintha D.C. (2018/E/104)</a></p>
        </div>
        
    </body>
</html>

<?php 

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])) {
        // Process for login
        // 1. Get the data from login form
        // $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // $password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // 2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1) {
            // User available and login success
            $_SESSION['login'] = "<div class='success'>Successfully logged in.</div>";
            $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it

            // Redirect to home page / dashboard
            header('location:'.SITEURL.'admin/');
        } else {
            // User not available and login failed
            $_SESSION['login'] = "<div class='error text-center'>Username or password doesn't match!</div>";
            // Redirect to home page / dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>