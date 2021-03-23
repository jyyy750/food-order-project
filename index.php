    <?php include('partials-front/menu.php');?>


    <!-- food-search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="post">
                <input type="search" name="search" placeholder="search for food..">
                <input type="submit" name="submit" value="search" class="btn-primary">
            </form>
        </div>
    </section>
    <!-- food-search Section Ends Here -->


<!--     session message appears after an order is taken place.-->

    <?php
    if (isset($_SESSION['register']))
    {
        echo $_SESSION['register'];
        unset($_SESSION['register']);
    }
    ?>

    <?php
    if (isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>

    <?php
        if (isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>





    <!-- Category Section Starts Here -->
    <section class="categories" >
        <div class="container">
            <h2 class="text-center">Category</h2>

            <?php
                // create sql query to display categories from db
                $sql = "SELECT * FROM tbl_category
                        WHERE active = 'Yes'
                        AND featured = 'Yes'
                        ";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    // check if image is available
                                    if ($image_name == "")
                                        {
                                            // display msg
                                            echo "<div class='error'>image not available</div>";
                                        }
                                    else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not added.</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Category Section Ends Here -->




    <!-- food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // get food from db where featured & active are Yes
                $sql2 = "SELECT * FROM tbl_food
                        WHERE active = 'Yes'
                        AND featured = 'Yes'
                        ";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if ($count2>0)
                {
                    while($row = mysqli_fetch_assoc($res2))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // check if img available
                                    if ($image_name == "")
                                        {
                                            // img unavailable
                                            echo "<div class='error'>Image unavailable.</div>";

                                        }
                                    else
                                        {
                                            // img available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title ;?></h4>
                                <br>

                                <p class="food-price">$<?php echo $price; ?></p>
                                <br>

                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary">Order Now</a>
                                <br>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food not available.</div>";
                }


                ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- food menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
