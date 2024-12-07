<?php
session_start();
require_once('../../lib/db.php'); 

$productID = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM product WHERE product_ID = ?");
$stmt->execute([$productID]);
$product = $stmt->fetch();

if (isset($_SESSION['user/ID'])) {
	$userID = $_SESSION['user/ID'];
	// Handle adding to cart
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	$quantity = ($_POST['quantity']);
    	if ($quantity > 0) {
        	$stmt = $pdo->prepare("SELECT Quantity FROM cart WHERE User_ID = ? AND Product_ID = ?");
        	$stmt->execute([$userID, $productID]);
        	$cartItem = $stmt->fetch();

        	if ($cartItem) {
            	$stmt = $pdo->prepare("UPDATE cart SET Quantity = Quantity + ? WHERE User_ID = ? AND Product_ID = ?");
            	$stmt->execute([$quantity, $userID, $productID]);
       		} 
        	else {
            	$stmt = $pdo->prepare("INSERT INTO cart (User_ID, Product_ID, Quantity) VALUES (?, ?, ?)");
            	$stmt->execute([$userID, $productID, $quantity]);
        	}
        	header("Location: cart.php"); 
        	exit;
    	}
	}
}
$productName = $product['name'] . " - Product Details";
require_once("../../theme/header.php"); 
setTitle($productName);
?>
<br>
<div style="text-align: center; margin-bottom: 20px;">
    <a href="index.php" class="btn btn-dark">Go Back</a>
</div>
<!-- Product section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <?php if (!empty($product['ImageURL'])): ?>
                    <img class="card-img-top mb-5 mb-md-0" src="<?php echo ($product['ImageURL']); ?>" alt="<?php echo ($product['name']); ?>" />
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder"><?php echo ($product['name']); ?></h1>
                <div class="fs-5 mb-5">
                    <span><?php echo "$" . number_format($product['price'], 2); ?></span>
                </div>
                <p class="lead"><?php echo ($product['description']); ?></p>
                <?php if (isset($_SESSION['user/ID'])) { ?>
                <form action="" method="POST">
                    <div class="d-flex">
                        <input class="form-control text-center me-3" name="quantity" type="number" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>Add to cart
                        </button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
require_once("../../theme/footer.php"); 
?>



