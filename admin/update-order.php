<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>

        <?php

            // check if id is set
            if (isset($_GET['id']))
            {
                // get details
                $id = $_GET['id'];

                // get other details based on the id
                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                $res = mysqli_query($conn,$sql);
                if ($res == TRUE)
                {
                    $count = mysqli_num_rows($res);
                    if ($count == 1)
                    {
                        // detail available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $status = $row['status'];  // Ordered, On delivery, Delivered, Cancelled
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                        }
                    }
                    else
                    {
                        // detail unavailable-> redirect to manage-order page
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
            }
            else
            {
                // redirect to manage-order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>$<b><?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">

                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea type="text" name="customer_address" value=""<?php echo $customer_address; ?> rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            // check if update button is clicked
            if (isset($_POST['submit']))
            {
                // get all values from the form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];  // Ordered, On delivery, Delivered, Cancelled
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // update the values
                $sql2 = "UPDATE tbl_order SET 
                                qty = $qty,
                                total = $total,
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address' WHERE id = $id
                                ";

                $res2 = mysqli_query($conn,$sql2);

                if ($res2 == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Fail to Updated Order </div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>
