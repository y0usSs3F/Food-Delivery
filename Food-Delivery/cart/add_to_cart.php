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

$user_id = $_SESSION['customer']['id'];

if (isset($_GET['food_id'])) {
    $food_id = (int) $_GET['food_id'];

    $sql_check = "SELECT * FROM cart WHERE user_id = ? AND food_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $user_id, $food_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // If the item already exists in the cart, increase the quantity
        $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND food_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $user_id, $food_id);
        $stmt_update->execute();
    } else {
        // If the item is not in the cart, insert a new record
        $sql_insert = "INSERT INTO cart (user_id, food_id, quantity) VALUES (?, ?, 1)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $user_id, $food_id);
        $stmt_insert->execute();
    }

    // Still exist on the main page index.php
    header("Location: ../index.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
