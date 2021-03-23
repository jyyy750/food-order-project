<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            // check whether id is set
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id =$id";
                $res = mysqli_query($conn,$sql);
                if ($res==TRUE)
                {
                    $count = mysqli_num_rows($res);
                    if ($count==1)
                    {
                        // get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        // redirect to manage-category page w\ Session msg
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');

                    }
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if ($current_image != "")
                            {
                                // display the image
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                
                                <?php

                            }
                            else
                            {
                                // display msg
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if (isset($_POST['submit']))
            {
                // 1. get all the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. update new img if selected
                // check if the image is selected
                if (isset($_FILES['image']['name']))
                {
                    // get the img detail
                    $image_name = $_FILES['image']['name'];
                    // check whether the image is available
                    if ($image_name != "")
                    {
                        // img available ->
                        // 1. upload the new img


                        // auto rename the image
                        // get the extension(jpg, png etc)
                        $ext = end(explode('.', $image_name));
                        // rename the image
                        $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;  //Food_Category_309.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        // check whether the img is uploaded or not
                        if ($upload == false) {
                            // set msg
                            $_SESSION['upload'] = "<div class='error'>Fail to upload image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }


                        // 2. remove the old/current one
                        if ($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            // check if the image is removed
                            if ($remove == false)
                            {
                                // fail to remove
                                $_SESSION['failed-remove'] = "<div class='error'>Fail to remove image</div>";
                                header('location:' . SITEURL . 'admin/manage-category.php');
                                die();
                            }
                        }

                    }
                    else
                    {
                        // no update on image
                        $image_name = $current_image;
                    }
                }
                else
                {
                    // no update on image
                    $image_name = $current_image;
                }

                // 3. update db
                $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                        ";

                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == TRUE)
                {
                    // category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // fail to update
                    $_SESSION['update'] = "<div class='error'>Fail to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                // 4. redirect to manage category w\ msg
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>
