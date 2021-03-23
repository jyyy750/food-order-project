<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br >

        <?php
            if (isset($_SESSION['add'])) // check whether the session is set or not
            {
                echo $_SESSION['add']; // display session msg
                unset($_SESSION['add']); // remove session msg
            }
        ?>

        <form action="" method="post" >
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php');?>

<?php
    // Process the value from the form & Save it in db

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Button clicked
        // 1. get the data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password Encryption with MD5

        // 2. create Sql query to save the data into db
        $sql = "INSERT INTO tbl_admin SET
                full_name = '$full_name',
                username = '$username',
                password = '$password'
                ";

        // 3. execute query & save data into db
        // $conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        // $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. check whether the query is executed or not & display corresponding msg
        if($res==True)
        {
            // data inserted
            // create a session variable to display msg
            $_SESSION['add'] = "Admin Added Successfully";
            // redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');


        }
        else
        {
            // fail to insert data
            // create a session variable to display msg
            $_SESSION['add'] = 'Fail to Add Admin';
            // redirect page to aff admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }
    }

?>

