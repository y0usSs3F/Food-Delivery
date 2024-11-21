<?php

// SESSION // 

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if (!isset($_SESSION['admin'])) {
    
    header("Location: ./signin.html");
    exit();
} else {

    header("Location: ./admin.php");
    exit();

}


?>
