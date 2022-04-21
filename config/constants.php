<?php 
    // Start session
    session_start();

    // Create constants to store non repeating values
    define('SITEURL', 'http://localhost/pharmacy-management-system/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'pharmacy-management-system');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecting database 

?>