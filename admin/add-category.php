<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php
                if (isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!--Add Category Form Starts Here-->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="add category" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            <!--Add Category Form Ends Here-->

            <?php
                // check whether the submit button is clicked or not
                if (isset($_POST['submit']))
                {
                    // 1. get the value from category form
                    $title = $_POST['title'];

                    // for radio input type, need to check the option is selected or not
                    if (isset($_POST['featured']))
                    {
                        // clicked -> get the value from the form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        // not clicked -> set it to default value
                        $featured = "No";
                    }

                    if (isset($_POST['active']))
                    {
                        // clicked -> get the value from the form
                        $active = $_POST['active'];
                    }
                    else
                    {
                        // not clicked -> set it to default value
                        $active = "No";
                    }

                    // check whether the image is selected or not
//                    print_r($_FILES['image']);
//
//                    die(); // break the code here

                    if (isset($_FILES['image']['name']))
                    {
                        // upload the img
                        // to upload img, we need image_name, source_path and destination_path
                        $image_name = $_FILES['image']['name'];

                        // upload img only if image is selected
                        if ($image_name != "")
                        {
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
                                header('location:' . SITEURL . 'admin/add-category.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        // don't upload the img & set image_name as blank
                        $image_name = "";
                    }

                    // 2. create sql query to insert category into db
                    $sql = "INSERT INTO tbl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            ";

                    // 3. execute the query & save it into db
                    $res = mysqli_query($conn,$sql);

                    // 4. check execution
                    if ($res==TRUE)
                    {
                        // query executed & category added
                        $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        // fail to add category
                        $_SESSION['add'] = "<div class='error'>Fail to Add Category</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }

            ?>
    </div>

<?php include('partials/footer.php'); ?>

