<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
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
        // 1. get the data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. check whether the user with current id and pw exist
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";
        $res = mysqli_query($conn, $sql);

        if ($res==TRUE)
        {
            $count = mysqli_num_rows($res);

            if ($count == 1)
            {
                // user exists & pw can be changed
                // check whether the new pw &confirm pw match
                if ($new_password == $confirm_password)
                {
                    // update
                    $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            WEHRE id = $id
                            ";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2==TRUE)
                    {
                        // display success msg
                        $_SESSION['change_pwd'] = "<div class='success'>Password Change Successfully.</div>";
                        header('location'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        // display error msg
                        $_SESSION['change_pwd'] = "<div class='error'>Password Change Unsuccessfully.</div>";
                        header('location'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd_not_match'] = "<div class='error'>Password NOT Match</div>";
                    header('location'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user_not_found'] = "<div class='error'>User NOT Found</div>";
                header('location'.SITEURL.'admin/manage-admin.php');
            }
        }

    }

?>

<?php include('partials/footer.php') ?>

