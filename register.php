<?php include('config/constants.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Register</h1>

        <form action="" method="post" >
            <table class="tbl-30">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="fullname" placeholder="Enter Your Full name"></td>
                </tr>


                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td>Phone Number:</td>
                    <td><input type="text" name="phone" placeholder="Enter Your Phone Number"></td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" placeholder="Enter Your Email"></td>
                </tr>

                <tr>
                    <td>Card Number:</td>
                    <td><input type="password" name="card" placeholder="Enter Your Card Number"></td>
                </tr>

                <tr>
                    <td>Default Address:</td>
                    <td><input type="text" name="address" placeholder="Enter Your Address"></td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Register" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php
    // Process the value from the form & Save it in db

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Button clicked
        // 1. get the data from the form
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $password = md5($_POST['password']); // Password Encryption with MD5
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $card = $_POST['card'];
        $address = $_POST['address'];

        // 2. create Sql query to save the data into db
        $sql = "INSERT INTO tbl_customers SET
                    username = '$username',
                    full_name = '$fullname',
                    password = '$password',
                    phone = '$phone',
                    email = '$email',
                    card = '$card'
                    ";


        // 3. execute query & save data into db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. check whether the query is executed or not & display corresponding msg
        if($res==True)
        {
            // data inserted
            // create a session variable to display msg
            $_SESSION['register'] = "Register Successfully";
            // redirect page to manage admin
            //header("location:".SITEURL);
        }
        else
        {
            // fail to insert data
            // create a session variable to display msg
            $_SESSION['register'] = 'Fail to Register';
            // redirect page to aff admin
            header("location:".SITEURL.'register.php');

        }

        $sql2 = "INSERT INTO address_book SET 
                user_id = (SELECT max(id) FROM tbl_customers),
                address = '$address'
                ";
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
        if($res==True)
        {
            // data inserted
            // create a session variable to display msg

            // redirect page to manage admin
            header("location:".SITEURL);
        }
        else
        {
            // fail to insert data
            // create a session variable to display msg
            $_SESSION['register'] = 'Fail to Register';
            // redirect page to aff admin
            header("location:".SITEURL.'register.php');

        }

    }




?>
