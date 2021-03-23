<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price：</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                                // display categories from db
                                // 1. create sql query to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE)
                                {
                                    $count = mysqli_num_rows($res);
                                    if ($count >= 1)
                                    {
                                        // we have categories
                                        // 2. display on a dropdown menu
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // we don't have categories
                                        ?>
                                        <option value="0">No Category Found</option>

                                        <?php

                                    }
                                }


                            ?>
                          

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" value="Yes" name="featured"> Yes
                        <input type="radio" value="No" name="featured"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" value="Yes" name="active"> Yes
                        <input type="radio" value="No" name="active"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>

                </tr>

            </table>

        </form>

        <?php
            // check if the submit button is clicked
            if (isset($_POST['submit']))
            {
                // clicked -> add it to db
                // 1. get the data from form
                $title = $_POST['title'];
                $description= $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];


                if (isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];

                }
                else
                {
                    $featured = "No"; // default
                }


                if (isset($_POST['active']))
                {
                    $active = $_POST['active'];

                }
                else
                {
                    $active = "No"; // default
                }


                // 2. upload the image if selected
                // check whether the select img is clicked -> if yes, upload
                if (isset($_FILES['image']['name']))
                {
                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != "")
                    {
                        // image name not blank -> is selected
                        // 1. rename the image
                        $ext = end(explode('.',$image_name));
                        $image_name = "Food_Name_".rand(0000,9999).".".$ext;

                        // 2. upload the image
                        // get source path & destination path
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if ($upload == false)
                        {
                            // fail to upload
                            $_SESSION['upload'] = "<div class='error'>Fail to upload image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; // default is none
                }

                // 3. insert it into the db
                $sql2 = "INSERT INTO tbl_food SET 
                         description = '$description',
                         price = $price,
                         image_name = '$image_name',
                         category_id = $category,
                         featured = '$featured',
                         active = '$active',
                         title = '$title'
                         ";

                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == TRUE)
                {
                    // data inserted successfully
                    // 4. redirect to manage-food page w\ msg
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Fail to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');

                }

            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
