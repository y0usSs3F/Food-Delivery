<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $username = preg_replace("/[^a-zA-Z0-9]/", "", $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "";
    $sql = "SELECT * FROM admins WHERE username=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {

        echo "Error: " . $stmt->error;
        exit();
    }
    
    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if (password_verify($password, $storedPassword)) {

            // echo "Login successful!";

            $_SESSION['admin'] = true;
            header("Location: admin.php");
            exit();

        } else {

            echo "Login failed. Check your username and password.";
        }
    } else {

        echo "Login failed. Check your username and password.";
    }

    $stmt->close();
}

$conn->close();

?>
