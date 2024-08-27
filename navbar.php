<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">E-Commerce</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="list_product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_product.php">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign_out.php">Sign Out</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="sign_in.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign_up.php">Sign Up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
