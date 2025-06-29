<?php
include "db.php";
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] == 'customer') {
    echo "Access denied.";
    exit;
}

$res = $conn->query("SELECT q.*, u.name FROM queries q JOIN users u ON q.user_id = u.id ORDER BY q.created_at DESC");

while ($row = $res->fetch_assoc()) {
    echo "<p><strong>{$row['name']}:</strong> {$row['message']} <em>({$row['created_at']})</em></p>";
}
?>