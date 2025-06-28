<?php
// --- Database connection ---
$host = 'localhost';
$user = 'root';
$pass = '123456'; // your MySQL password
$db = 'crud_demo';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Handle form submission ---
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (isset($_POST['create'])) {
        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        $message = $conn->query($sql) ? "User created." : "Error: " . $conn->error;
    }

    if (isset($_POST['read'])) {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
    }

    if (isset($_POST['update'])) {
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
        $message = $conn->query($sql) ? "User updated." : "Error: " . $conn->error;
    }

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM users WHERE id=$id";
        $message = $conn->query($sql) ? "User deleted." : "Error: " . $conn->error;
    }
}
?>

<!-- --- HTML Form --- -->
<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP CRUD</title>
</head>
<body>
    <h2>Simple CRUD in PHP</h2>
    <form method="post">
        ID: <input type="number" name="id"><br><br>
        Name: <input type="text" name="name"><br><br>
        Email: <input type="email" name="email"><br><br>

        <button type="submit" name="create">Create</button>
        <button type="submit" name="read">Read</button>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="delete">Delete</button>
    </form>

    <p><?php echo $message; ?></p>

    <?php
    if (isset($result) && $result->num_rows > 0) {
        echo "<h3>User List:</h3><table border='1'><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td></tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>
