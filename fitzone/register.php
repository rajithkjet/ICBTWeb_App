<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) echo "Registered successfully. <a href='login.php'>Login</a>";
    else echo "Error: " . $stmt->error;
}
?>
<form method="post">
    Name: <input name="name"><br>
    Email: <input name="email"><br>
    Password: <input name="password" type="password"><br>
    <button type="submit">Register</button>
</form>