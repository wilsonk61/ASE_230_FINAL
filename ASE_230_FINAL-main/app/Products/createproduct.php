<?php
session_start(); 
require_once('../../lib/db.php'); 
if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0) {
    $stmt = $pdo->prepare("INSERT INTO product (name, price, ImageURL, description, created_by) VALUES (?, ?, ?, ?, ?)");
	$stmt->execute([$_POST['product_name'], $_POST['product_price'], $_POST['product_image'], $_POST['product_description'], $_SESSION['user/ID']]); 
    header('Location: index.php');
    exit;
}
require_once("../../theme/header.php"); 
setTitle("Create");
?>
    <br>
    <div style="text-align: center; margin-bottom: 20px; padding: 30px">
		<a href="index.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Return to Home Page</a>
	</div>
    <br>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; margin-bottom: 20px;">Add New Product</h3>
        <div style="margin-bottom: 15px;">
            <label for="product_name" style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="product_name" id="product_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product name" required />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="product_price" style="display: block; margin-bottom: 5px;">Product Price</label>
            <input type="text" name="product_price" id="product_price" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product price" required />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="product_image" style="display: block; margin-bottom: 5px;">Product Image URL</label>
            <input type="text" name="product_image" id="product_image" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product image URL" required />
        </div>
        <div style="margin-bottom: 20px;">
            <label for="product_description" style="display: block; margin-bottom: 5px;">Product Description</label>
            <textarea name="product_description" id="product_description" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product description" required></textarea>
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Add Product</button>
    </form>
<?php
require_once("../../theme/footer.php"); 
?>


