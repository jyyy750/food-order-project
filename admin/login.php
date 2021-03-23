<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../admin/admin.css"
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php
                if (isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if (isset($_SESSION['not-login-msg']))
                {
                    echo $_SESSION['not-login-msg'];
                    unset($_SESSION['not-login-msg']);
                }
            ?>
            <br>

            <!--Login Form Starts Here-->
            <form action="" method="POST" class="text-center">
                Username:<input type="text" name="username" placeholder="Enter Username">
                <br>
                Password:<input type="password" name="password" placeholder="Enter Password">
                <br><br>
                <input type="submit" name="submit" value="login" class="btn-primary">
                <br><br>
            </form>
            <!--Login Form Starts Here-->

            <p class="text-center">Created By - <a href="www.jyyu.com">JY Yu</a></p>
        </div>
    </body>
</html>


<?php
    // check if the submit button is clicked
    if (isset($_POST['submit']))
    {
        // process for login
        // 1. get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // 2. sql query checking if the username & pwd exist
        $sql = "SELECT * FROM tbl_admin WHERE
                username = '$username' AND
                password = '$password'
                ";

        // 3. execute
        $res = mysqli_query($conn, $sql);

        // 4. count rows to check if the user exists
        $count = mysqli_num_rows($res);

        if ($count==1)
        {
            // user available & login success
            $_SESSION['login'] = "<div class='success'> Successfully Registered!</div>";

            // check whether the user is login or not
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Registration Failed!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>
