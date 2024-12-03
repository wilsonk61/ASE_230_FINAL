<?php
require_once('../../lib/db.php'); 

$userID = intval($_GET['user_id']); 

$stmt = $pdo->prepare("DELETE FROM cart WHERE User_ID = ?");
$stmt->execute([$userID]);

header("Location: adminview.php");
exit;
