<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
echo "<h1>Welcome, {$user['name']}</h1>";
echo "<a href='book_appointment.php'>Book Appointment</a> | <a href='logout.php'>Logout</a><br>";

if ($user['role'] != 'customer') {
    echo "<a href='view_queries.php'>View Customer Queries</a><br>";
}
?>