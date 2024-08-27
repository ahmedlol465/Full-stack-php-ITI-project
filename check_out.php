<?php
include 'db.php';
include 'navbar.php';

// Fetch product details based on ID from the query string
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();

if (!$product) {
    die('Product not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container my-4">
    <h1>Checkout</h1>
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
            
            <!-- Payment Form -->
            <form action="process_checkout.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Confirm Purchase</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
