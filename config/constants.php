<?php

    // start session
    session_start();

    // create constants to store non-repeating values
    define('SITEURL', 'http://127.0.0.1/restaurant/');

    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','970519');
    define('DB_NAME','restaurant');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // db connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // select db

?>
