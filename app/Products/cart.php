<?php
require_once('../../lib/db.php'); 

// Simulated user ID
$userID = 3;

$stmt = $pdo->prepare("SELECT cart.Order_ID, cart.Quantity, product.name AS Product_Name, product.price AS Product_Price, (cart.Quantity * product.price) AS Total_Price FROM cart JOIN product ON cart.Product_ID = product.Product_ID WHERE cart.User_ID = ?");
$stmt->execute([$userID]);
$cartItems = $stmt->fetchAll();

$cartTotal = 0;
foreach ($cartItems as $item) {
    $cartTotal += $item['Total_Price'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="profile.php">Profile</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="createproduct.php">Make Your Own Product</a></li>
                    </ul>
                    <form class="d-flex">
                        <a href="auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
						<a href="cart.php" class="btn btn-outline-dark">cart</a>
                    </form>
                </div>
            </div>
        </nav>
    <br>
    <div class="container">
        <h1>Your Cart</h1>
        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= ($item['Order_ID']) ?></td>
                            <td><?= ($item['Product_Name']) ?></td>
                            <td>$<?= number_format($item['Product_Price']) ?></td>
                            <td><?= ($item['Quantity']) ?></td>
                            <td>$<?= number_format($item['Total_Price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total: $<?= number_format($cartTotal) ?></h3>
        <?php endif; ?>
		<a href="cart_clear.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear your cart?');">
			Clear Cart
		</a>
		<a href="cart_clear.php" class="btn btn-success" onclick="return confirm('Are you sure you want to order?');">
			Order
		</a>
    </div>


    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
</body>
</html>


