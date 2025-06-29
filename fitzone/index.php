<?php
include "db.php";
session_start();
?>
<h1>Welcome to FitZone Fitness Center</h1>
<a href="register.php">Register</a> | <a href="login.php">Login</a>
<h2>Our Classes</h2>
<ul>
<?php
$result = $conn->query("SELECT * FROM classes");
while ($row = $result->fetch_assoc()) {
    echo "<li><strong>{$row['name']}</strong>: {$row['description']}</li>";
}
?>
</ul>