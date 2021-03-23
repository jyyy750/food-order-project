    <?php include('partials-front/menu.php');?>

    <!-- food-search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                $search = $_POST['search'];
            ?>

            <h2>关于<?php echo $search; ?>的搜索结果如下</h2>

        </div>
    </section>
    <!-- food-search Section Ends Here -->



    <!-- food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // get the search keyword
                $sql = "SELECT * FROM tbl_food
                        WHERE title LIKE '%$search%' OR
                        description like '%$search%' OR 
                        category_id IN (SELECT id FROM tbl_category WHERE title LIKE '%$search%')";

                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if ($count >0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get details of food
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // check image is available or not
                                    if ($image_name == "")
                                    {
                                        // no img available
                                        echo "<div class='error'>No image available</div>";
                                    }
                                    else
                                    {
                                        // img available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"class="img-responsive img-curve">
                                        <?php

                                    }
                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>