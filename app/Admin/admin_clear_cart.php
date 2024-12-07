<?php
require_once('../../lib/db.php'); 
session_start();
if (!isset($_SESSION['user/ID']) || $_SESSION["user/admin"]!=1) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$userID = intval($_GET['user_id']); 

$stmt = $pdo->prepare("DELETE FROM cart WHERE User_ID = ?");
$stmt->execute([$userID]);

header("Location: adminview.php");
exit;
