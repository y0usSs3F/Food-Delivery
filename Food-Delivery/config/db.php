<?php
$servername = "localhost";
$username = "joey";
$password = "123";
$dbname = "Food-Delivery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>