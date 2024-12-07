<?php
require_once('../../lib/db.php');
session_start();
if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$userId = intval($_GET['id']);

if(!$_SESSION["user/admin"] == 1 && $_SESSION["user/ID"]!=$userId) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$delContacts=$pdo->prepare("DELETE FROM contact WHERE user_ID = ?");
$delContacts->execute([$userId]);

$delProducts=$pdo->prepare("DELETE FROM product WHERE created_by = ?");
$delProducts->execute([$userId]);


$delUser=$pdo->prepare("DELETE FROM user WHERE User_ID = ?");
$delUser->execute([$userId]);

header('Location: ../../lib/auth/signout.php');
exit;




