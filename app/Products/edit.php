<?php
session_start();
require_once('../../lib/db.php'); 
if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$productID = intval($_GET['id']); 

$stmt = $pdo->prepare("SELECT * FROM product WHERE product_ID = ?");
$stmt->execute([$_GET['id']]);
$product = $stmt->fetch();
if(!$_SESSION["user/admin"]==1 && $_SESSION["user/ID"]!=$product['created_by']) {
	header('Location: ../../lib/error/error.php');
	exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE product SET name = ?, price = ?, ImageURL = ?, description = ? WHERE product_ID = ?");
    $stmt->execute([
        $_POST['product_name'],
        $_POST['product_price'],
        $_POST['product_image'],
        $_POST['product_description'],
        $productID
    ]);

    header('Location: index.php');
    exit;
}
require_once("../../theme/header.php"); 
setTitle("Edit Product");
?>
    <br>
    <div style="text-align: center; margin-bottom: 20px; padding: 30px">
		<a href="index.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Return to Home Page</a>
	</div>
    <br>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; margin-bottom: 20px;">Edit Product</h3>
        <div style="margin-bottom: 15px;">
            <label for="product_name" style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="product_name" id="product_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($product['name']) ?>" required />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="product_price" style="display: block; margin-bottom: 5px;">Product Price</label>
            <input type="text" name="product_price" id="product_price" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($product['price']) ?>" required/>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="product_image" style="display: block; margin-bottom: 5px;">Product Image URL</label>
            <input type="text" name="product_image" id="product_image" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($product['ImageURL']) ?>" required/>
        </div>
        <div style="margin-bottom: 20px;">
            <label for="product_description" style="display: block; margin-bottom: 5px;">Product Description</label>
            <textarea name="product_description" id="product_description" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required><?= htmlspecialchars(($product['description'])) ?></textarea>
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Save Changes</button>
    </form>
<?php 
require_once("../../theme/footer.php"); 
?>

