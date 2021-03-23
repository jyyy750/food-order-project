<?php

    // check whether the user is login or not
    if (!isset($_SESSION['user'])) // if user session is not set:
    {
        // user not logged in
        // redirect ot login page w\ msg
        $_SESSION['not-login-msg'] = "<div class='error text-center'>Please login to access admin</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>