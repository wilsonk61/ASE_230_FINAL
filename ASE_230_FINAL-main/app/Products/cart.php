<?php
session_start();
require_once('../../lib/db.php'); 

if (!isset($_SESSION['user/ID'])) {
header('Location: ../../lib/error/error.php');
exit;
}
$userID = $_SESSION['user/ID'];;

$stmt = $pdo->prepare("SELECT cart.Order_ID, cart.Quantity, product.name AS Product_Name, product.price AS Product_Price, (cart.Quantity * product.price) AS Total_Price FROM cart JOIN product ON cart.Product_ID = product.Product_ID WHERE cart.User_ID = ?");
$stmt->execute([$userID]);
$cartItems = $stmt->fetchAll();

$cartTotal = 0;
foreach ($cartItems as $item) {
$cartTotal += $item['Total_Price'];
} 

require_once("../../theme/header.php"); 
setTitle('Cart');
?>
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
                        <td>$<?= number_format($item['Product_Price'], 2) ?></td>
                        <td><?= ($item['Quantity']) ?></td>
                        <td>$<?= number_format($item['Total_Price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total: $<?= number_format($cartTotal) ?></h3>
    <?php endif; ?>
    <a href="cart_clear.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear your cart?');">Clear Cart</a>
    <a href="cart_clear.php" class="btn btn-success" onclick="return confirmOrder();">Order</a>
    <script>
    function confirmOrder() {
        if (confirm('Are you sure you want to order?')) {
            alert('Thank you for your order!');
        } else {
        	return false;
        }
    }
    </script>
</div>
<?php
require_once("../../theme/footer.php"); 
?>
