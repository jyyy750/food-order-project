<?php

    // include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of admin to be deleted
    $id = $_GET['id'];

    // 2. create Sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id= $id";

    // 3. execute the query
    $res = mysqli_query($conn, $sql);

    // 4. check if the execution is successful or not
    if ($res==TRUE)
    {
        // success, admin deleted
        // create session variable to display msg
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Fail to Delete</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>
