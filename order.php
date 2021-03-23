<?php include('partials-front/menu.php');?>

    <?php
    // check if food id is set
    if (isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];

        // get details of the selected food(id)
        $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);

        if ($count == 1)
        {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        header('location:'.SITEURL);
    }
    ?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            // check whether the img is available
                            if ($image_name == "")
                            {
                                echo "<div class='error'>Image unavailable.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php

                            }
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>

                <?php
                    if (isset($_GET['user_id']))
                    {
                        $user_id = $_GET['user_id'];
                        // get corresponding user info
                        $sql2 = "SELECT * FROM tbl_customers WHERE id = $user_id";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);

                        if ($count2 == 1) {
                            $row2 = mysqli_fetch_assoc($res2);

                            $full_name = $row2['full_name'];
                            $phone = $row2['phone'];
                            $email = $row2['email'];
                            //$address = $row2['address'];
                        }
                    }
                    else
                    {
                        header('location:'.SITEURL);
                    }
                ?>


                <?php
                    //$user_id = $_GET['user_id'];
                    $sql3 = "SELECT * FROM address_book WHERE user_id = $user_id LIMIT 1";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);

                    if ($count3 == 1) {
                        $row3 = mysqli_fetch_assoc($res3);

                        $address = $row3['address'];

                    }

                ?>



                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" value="<?php echo $full_name; ?>" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" value="<?php echo $phone; ?>" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <input type="text" name="address" value="<?php echo $address; ?>" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                // check if submit button is clicked
                if (isset($_POST['submit']))
                {
                    // get all details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered";  // Ordered, On delivery, Delivered, Cancelled
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $address = $_POST['address'];

                    // save the order in db
                    $sql2 = "INSERT INTO tbl_order SET 
                                food ='$food',
                                price = $price,
                                qty = $qty,
                                total = $total,
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$address'
                                ";

                    $res2 = mysqli_query($conn,$sql2);
                    if ($res2 == TRUE)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>成功下单</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error'>下单失败</div>";
                        header('location:'.SITEURL);
                    }


                }
            ?>

        </div>
    </section>
    <!-- fOOD search Section Ends Here -->

    <?php include('partials-front/footer.php');?>