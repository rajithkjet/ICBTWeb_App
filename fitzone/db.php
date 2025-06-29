<?php
$host = "localhost";
$user = "root";
$pass = "123456";
$db = "fitzone";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>