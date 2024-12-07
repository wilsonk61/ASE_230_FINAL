<?php
session_start();

require_once('../../lib/db.php'); 
if(count($_POST)>0 && isset($_POST['action']{0})){
	if($_POST['action']=='Sign Up') signup($pdo);
	else signin($pdo);
}


function signin($pdo){
	
	$stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
	$stmt->execute([$_POST["email"]]);
	if ($stmt->rowCount()==0) { 
		$_SESSION['error_message'] = "Invalid Email or Password";
		header('Location: signin.php');
		exit;
	} 
	$user = $stmt->fetch();
	if(!password_verify($_POST["password"],$user["password"])) {
		$_SESSION['error_message'] = "Invalid Email or Password"; 
		header('Location: signin.php');
		exit;
	}
	else {
	$_SESSION["user/ID"]=$user["User_ID"];
	$_SESSION["user/email"]=$user["email"];
	$_SESSION["user/name"]=sprintf("%s %s",$user["first_name"],$user["last_name"]);
	$_SESSION["user/admin"]=$user["isAdmin"];
	header ('location: ../../app/Users/profile.php?id='.$user['User_ID']);
	exit;
	}
}

function signup($pdo){
	require_once('../../lib/db.php'); 
	$stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
	$stmt->execute([$_POST["email"]]);
	if ($stmt->rowCount() > 0) { 
		$_SESSION['error_message'] = "Email already registered. Please use a different email.";
		header('Location: signup.php');
		exit;
	} 
	else {
		$stmt = $pdo->prepare("INSERT INTO user (email,password) VALUES (?,?)");
		$stmt->execute([$_POST['email'],password_hash($_POST['password'],PASSWORD_DEFAULT)]);
		header('location: ../../lib/auth/signin.php');
		exit;
	}
}

function signout(){
	session_destroy();
	header("location: signin.php");
	exit;
}

?>
