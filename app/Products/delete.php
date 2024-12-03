<?php
require_once('../../lib/db.php'); 

$productID = intval($_GET['id']); 

$stmt = $pdo->prepare("DELETE FROM product WHERE product_ID = ?");
$stmt->execute([$productID]);

header('Location: index.php');
exit;


