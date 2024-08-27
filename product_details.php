<?php
include 'db.php';
include 'navbar.php';

// Fetch product details based on ID
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <?php if ($product): ?>
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <?php if (!empty($product['photo'])): ?>
                <img src="<?php echo htmlspecialchars($product['photo']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <?php else: ?>
                <img src="https://themesberg.com/docs/bootstrap-5/pixel/assets/img/shop/item-1.png" class="card-img-top" alt="Default Product Image">
            <?php endif; ?>

            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="card-text">$<?php echo htmlspecialchars($product['price']); ?></p>
                <a href="check_out.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-success btn-sm">Buy Now</a>
            </div>
        </div>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
