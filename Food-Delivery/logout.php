<?php

session_start();

// Unset all session variables
$_SESSION = array();

session_destroy();

// Redirect to the login page after logout
header("Location: ./signin/signin.html");
exit();

?>
