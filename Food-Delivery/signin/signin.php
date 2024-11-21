<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prevent XSS Attacks here
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // Prepared SQL statement to prevent SQL Injection
    $sql = "SELECT * FROM users WHERE username=?";
    
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
            session_start();

            // Correctly structure the session
            $_SESSION['customer'] = [
                'id' => $row['id'],  // Store the user's ID
                'name' => $row['username'] // Store the username or other user info
            ];
            
            header("Location: ../index.php");
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
