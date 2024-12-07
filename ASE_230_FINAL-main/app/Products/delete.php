<?php
session_start();
require_once('../../lib/db.php'); 
if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$productID = intval($_GET['id']); 

$stmt = $pdo->prepare("SELECT created_by FROM product WHERE product_ID = ?");
$stmt->execute([$productID]);
$created_by = $stmt->fetchColumn();

if(!$_SESSION["user/admin"]==1 && $_SESSION["user/ID"]!=$created_by) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$stmt = $pdo->prepare("DELETE FROM product WHERE product_ID = ?");
$stmt->execute([$productID]);

header('Location: index.php');
exit;


