<?php
include 'db.php';
include 'navbar.php';

// Fetch products from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Product List</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card mb-4 shadow-sm border-0" style="border-radius: 15px;">
                    <?php if (!empty($product['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($product['photo']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <img src="https://themesberg.com/docs/bootstrap-5/pixel/assets/img/shop/item-1.png" class="card-img-top" alt="Default Product Image">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">$<?php echo htmlspecialchars($product['price']); ?></p>
                        <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary btn-sm">View Details</a>
                        <a href="checkout.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-secondary btn-sm">Buy Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
