<?php include('partials/menu.php');?>

<!-- Main Content Section Starts Here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // display session msg
                unset($_SESSION['add']); // remove session msg
            }

            if (isset($_SESSION['delete']))
            {
                echo $_SESSION['delete']; // display session msg
                unset($_SESSION['delete']); // remove session msg
            }

            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update']; // display session msg
                unset($_SESSION['update']); // remove session msg
            }

            if (isset($_SESSION['user_not_found']))
            {
                echo $_SESSION['user_not_found']; // display session msg
                unset($_SESSION['user_not_found']); // remove session msg
            }

            if (isset($_SESSION['pwd_not_match']))
            {
                echo $_SESSION['pwd_not_match']; // display session msg
                unset($_SESSION['pwd_not_match']); // remove session msg
            }

            if (isset($_SESSION['change_pwd']))
            {
                echo $_SESSION['change_pwd']; // display session msg
                unset($_SESSION['change_pwd']); // remove session msg
            }
        ?>

        <br /> <br />


        <!-- Button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /> <br /><br /> <br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <!--display the admin from db-->
            <?php
                // query to get all admin
                $sql = "SELECT * FROM tbl_admin";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // check whether the query is executed or not
                if ($res==TRUE)
                {
                    // count rows to check if we have data in db
                    $count = mysqli_num_rows($res);
                    if ($count > 0)
                    {
                        // have data in db
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            // use while loop to get all the data from db
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            // display values in the table
                            ?>

                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin </a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php


                        }
                    }
                    else
                    {
                        // no data in db
                    }
                }
                else
                {

                }

            ?>


        </table>


    </div>
</div>
<!-- Main Content Section Ends Here -->

<?php include('partials/footer.php');?>