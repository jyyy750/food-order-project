<?php include('../config/constants.php');?>

<?php
    if (isset($_GET['id']) && isset($_GET['image_name']))
    {
        // process to delete

        // 1. get id & image_name
        $id = $_GET['id'];
        $image_name= $_GET['image_name'];

        // 2. remove the img if existed
        if ($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if ($remove == FALSE)
            {
                $_SESSION['upload'] = "<div class='error'>Fail to remove image file.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }

        }

        // 3. delete food from db
        $sql = "DELETE FROM tbl_food WHERE
                id=$id";
        $res = mysqli_query($conn,$sql);
        if ($res == TRUE)
        {
            // food deleted
            $_SESSION['delete'] = "<div class='success'>Remove food successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            // fail to delete food
            $_SESSION['delete'] = "<div class='error'>Fail to remove food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }


    }
    else
    {
        // redirect to manage food page
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>
