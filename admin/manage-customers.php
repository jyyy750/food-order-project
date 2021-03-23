<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Customers</h1>
        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>id</th>
                <th>username</th>
                <th>full name</th>
                <th>phone</th>
                <th>email</th>


            </tr>

            <?php
            // get all orders from db
            $sql = "SELECT * FROM tbl_customers";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if ($count > 0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    // get details
                    $id = $row['id'];
                    $username = $row['username'];
                    $fullname = $row['full_name'];
                    $phone = $row['phone'];
                    $email = $row['email'];


                    ?>

                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $email; ?></td>



                    </tr>

                    <?php
                }


            }
            else
            {

            }
            ?>


        </table>
    </div>
</div>







<?php include('partials/footer.php');?>



