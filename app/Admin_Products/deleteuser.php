<?php
require_once('../../lib/db.php');

$userId = intval($_GET['id']); // Ensure User_ID is an integer

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

$pdo->prepare("DELETE FROM contact WHERE user_ID = ?")->execute([$userId]);

$pdo->prepare("DELETE FROM product WHERE created_by = ?")->execute([$userId]);

$pdo->prepare("DELETE FROM user WHERE User_ID = ?")->execute([$userId]);

$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

header('Location: adminview.php');
exit;



