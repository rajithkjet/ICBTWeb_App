<?php
include "db.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res && password_verify($pass, $res['password'])) {
        $_SESSION['user'] = $res;
        header("Location: dashboard.php");
    } else {
        echo "Invalid login";
    }
}
?>
<form method="post">
    Email: <input name="email"><br>
    Password: <input name="password" type="password"><br>
    <button type="submit">Login</button>
</form>