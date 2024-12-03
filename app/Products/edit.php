<?php
require_once('../../lib/db.php'); 

$productID = intval($_GET['id']); 

$stmt = $pdo->prepare("SELECT * FROM product WHERE product_ID = ?");
$stmt->execute([$productID]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE product SET name = ?, price = ?, ImageURL = ?, description = ? WHERE product_ID = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['price'],
        $_POST['image'],
        $_POST['description'],
        $productID
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <br>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="index.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Go Back</a>
    </div>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form action="<?= ($_SERVER['PHP_SELF']) ?>?id=<?= $productID ?>" method="POST">
        <div>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" value="<?= ($product['name']) ?>" required>
        </div>
        <div>
            <label for="price">Product Price</label>
            <input type="text" name="price" id="price" value="<?= ($product['price']) ?>" required>
        </div>
        <div>
            <label for="image">Product Image URL</label>
            <input type="text" name="image" id="image" value="<?= ($product['ImageURL']) ?>" required>
        </div>
        <div>
            <label for="description">Product Description</label>
            <textarea name="description" id="description" rows="4" required><?= ($product['description']) ?></textarea>
        </div>
        <button type="submit">Save Changes</button>
    </form>
</div>
</body>
</html>

