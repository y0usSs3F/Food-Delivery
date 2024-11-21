<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //
    // Prevent XSS Attacks here :P
    // 

    $fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8');

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');

    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    $phonenumber = htmlspecialchars($_POST['phonenumber'], ENT_QUOTES, 'UTF-8');


    $username = mysqli_real_escape_string($conn, $username);
    $username = preg_replace("/[^a-zA-Z0-9]/", "", $username);
    $password = mysqli_real_escape_string($conn, $password);


    // convert the clear text password provided to a bcrypt hash value to store it on the database.

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "";

    $sql = "INSERT INTO users (fullname, username, email, password, phonenumber) VALUES (?, ?, ?, ?, ?)";

    try{
        
        // Prevent SQL Injection Attacks here ====> (Prepared Statements)

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fullname, $username, $email, $hashedPassword, $phonenumber);
        $stmt->execute();

    } catch (mysqli_sql_exception $e) {

        header("Location: signup.html"); // Redirect the user back to the signup page again if there's an error ===> for example (there's an existing user with the provided username)
        exit();
    }
    
    if ($stmt->error) {

        echo "Error: " . $stmt->error;
        exit();

    } else {

        header("Location: ../signin/signin.html");
    }

    $stmt->close();
}


$conn->close();
?>
