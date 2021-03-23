
<?php include('../config/constants.php'); ?>

<?php

    // check if id & image_name are set or not
    if (isset($_GET['id']) && isset($_GET['image_name']))
    {
        // get value & delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical image file is available
        if ($image_name != "")
        {
            // img available->remove it
            $path = "../images/category/".$image_name;
            // remove it
            $remove = unlink($path);
            // if fail to remove, then add error msg and stop the process
            if ($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Fail to remove category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        // delete data from db
        $sql = "DELETE FROM tbl_category WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>category deleted unsuccessfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
