<?php
include 'db.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Prepare and execute the SQL statement to insert product
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);

    // Get the last inserted product ID
    $productId = $pdo->lastInsertId();

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions and maximum file size
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        if (in_array($fileExtension, $allowedExts) && $fileSize <= $maxFileSize) {
            $uploadDir = 'uploads/';
            $newFileName = $productId . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move the file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update the product record with the photo path
                $stmt = $pdo->prepare("UPDATE products SET photo = ? WHERE id = ?");
                $stmt->execute([$destPath, $productId]);
                echo "Product added with photo.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        echo "Product added without a photo.";
    }

    // Redirect to the product list page
    header('Location: list_product.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Add Product</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="photo">Product Photo (optional)</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
</body>
</html>
