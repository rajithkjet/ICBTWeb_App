<?php
include "db.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $msg = $_POST['message'];
    $uid = $_SESSION['user']['id'];

    $stmt = $conn->prepare("INSERT INTO appointments (user_id, class_id, date, time, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $uid, $class_id, $date, $time, $msg);
    $stmt->execute();
    echo "Appointment requested.";
}
?>
<form method="post">
    Class:
    <select name="class_id">
        <?php
        $res = $conn->query("SELECT * FROM classes");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br>
    Date: <input name="date" type="date"><br>
    Time: <input name="time" type="time"><br>
    Message: <textarea name="message"></textarea><br>
    <button type="submit">Book</button>
</form>