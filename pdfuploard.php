
<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdf_file"])) {
    $file = $_FILES["pdf_file"];

    // Validate file type
    if ($file["type"] != "application/pdf") {
        echo "Only PDF files are allowed.";
        exit;
    }

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = basename($file["name"]);
    $target_file = $upload_dir . time() . "_" . $file_name;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO pdf_uploads (file_name, file_type, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $file_name, $file["type"], $target_file);
        $stmt->execute();
        echo "PDF uploaded and saved to database.";
    } else {
        echo "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Upload a PDF File</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" name="pdf_file" accept="application/pdf" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
</body>
</html>
