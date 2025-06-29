<?php
// Check for file path parameter
if (!isset($_GET['file'])) {
    echo "No file specified.";
    exit;
}

$file = $_GET['file'];
$file_path = "uploads/" . basename($file);

// Check if file exists and is a PDF
if (!file_exists($file_path) || mime_content_type($file_path) != 'application/pdf') {
    echo "Invalid file.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preview PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>PDF Preview</h2>
    <div class="border p-3">
        <iframe src="<?php echo $file_path; ?>" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
    </div>
</div>
</body>
</html>
