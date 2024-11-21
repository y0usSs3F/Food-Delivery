<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../config/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer'])) {
    header("Location: ../signin/signin.html");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['customer']['id'];

// Get the food_id from the URL query string
if (isset($_GET['food_id'])) {
    $food_id = (int) $_GET['food_id'];

    // Delete the item from the user's cart
    $sql_delete = "DELETE FROM cart WHERE user_id = ? AND food_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("ii", $user_id, $food_id);
    $stmt_delete->execute();


    // Redirect to the cart page after adding the item
    header("Location: ../cart/cart.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
