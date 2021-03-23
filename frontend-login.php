<?php include('config/constants.php');?>

<html>
    <head>
        <link rel="stylesheet" href="../style.css"
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <?php
            if (isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>

            <?php
            if (isset($_SESSION['user']))
            {
                header('location:'.SITEURL);

            }

            ?>
            <br><br>





            <!--Login Form Starts Here-->
            <form action="" method="POST" class="text-center">
                Username: <input type="text" name="username" placeholder="Enter Username">
                <br><br>
                Password: <input type="password" name="password" placeholder="Enter Password">
                <br><br>
                <input type="submit" name="submit" value="login" class="btn-primary">
                <br><br>
            </form>
            <!--Login Form Starts Here-->

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
        $sql = "SELECT * FROM tbl_customers WHERE
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
            $_SESSION['login'] = "<div class='success'>login successful</div>";
            // check whether the user is login or not
            $_SESSION['user'] = $username;

            // try to get the id
            $row = mysqli_fetch_assoc($res);
            $user_id =  $row['id'];
            //using session
            $_SESSION['user_id'] = $user_id;

            header('location:'.SITEURL);

        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>login NOT successful</div>";
            header('location:'.SITEURL.'frontend-login.php');
        }

    }

?>
