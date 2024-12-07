<?php
require_once('../../lib/db.php');

session_start();
if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}
// Simulated user ID (replace with session-based user ID when implemented)
$userID = $_SESSION['user/ID'];

$stmt = $pdo->prepare("DELETE FROM cart WHERE User_ID = ?");
$stmt->execute([$userID]);

header("Location: cart.php");
exit;

