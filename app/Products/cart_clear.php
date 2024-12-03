<?php
require_once('../../lib/db.php');

// Simulated user ID (replace with session-based user ID when implemented)
$userID = 3;

$stmt = $pdo->prepare("DELETE FROM cart WHERE User_ID = ?");
$stmt->execute([$userID]);

header("Location: cart.php");
exit;

