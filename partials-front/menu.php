<?php include('config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- important to make website responsive -->
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <title>res website</title>

    <!-- Link our css file -->
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">
        <div class="logo">

        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>foods.php">Food</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>frontend-login.php">Log in</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>register.php">Register</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>frontend-logout.php">Log Out</a>
                </li>
                
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Navbar Section Ends Here -->