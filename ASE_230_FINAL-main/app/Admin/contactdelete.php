<?php
require_once('../../lib/db.php');
session_start();
if (!isset($_SESSION['user/ID']) || $_SESSION["user/admin"]!=1) {
	header('Location: ../../lib/error/error.php');
	exit;
}

$contactId = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM contact WHERE Contact_ID = ?");
$stmt->execute([$contactId]);

header('Location: adminview.php');
exit;


