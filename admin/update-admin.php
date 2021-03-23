<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <?php
            // 1. get id of selected admin
            $id = $_GET['id'];
            // 2. create sql query
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            // 3. execute the query
            $res = mysqli_query($conn, $sql);
            // 4. check execution
            if ($res == TRUE)
            {
                $count = mysqli_num_rows($res);
                if ($count == 1)
                {
                    // get details
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];

                }
                else
                {
                    // redirect to manage-admin page
                    header('location'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>


        <form action="" method="POST">
            <table CLASS="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>

</div>

<?php
    // check whether the submit button is clicked or not
    if (isset($_POST['submit']))
    {
        // get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // create sql query
        $sql = "UPDATE tbl_admin
                SET full_name = '$full_name',
                username = '$username'
                WHERE id = $id
                ";

        // execute
        $res = mysqli_query($conn,$sql);

        // check execution
        if ($res==TRUE)
        {
            // admin updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            // redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // fail to update

            $_SESSION['update'] = "<div class='error'>Fail to Update</div>";
            // redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }
?>

<?php include('partials/footer.php'); ?>
