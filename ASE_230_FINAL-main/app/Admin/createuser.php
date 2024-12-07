<?php
require_once('../../lib/db.php');
session_start();
if (!isset($_SESSION['user/ID']) || $_SESSION["user/admin"]!=1) {
	header('Location: ../../lib/error/error.php');
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, email, password, isAdmin) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $password, $isAdmin]);

    header('Location: adminview.php');
    exit;
}
require_once("../../theme/header.php"); 
setTitle("Create User Profile");
?>
	<div style="text-align: center; margin-bottom: 20px; padding: 30px">
		<a href="adminview.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Return to Admin View</a>
	</div>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; margin-bottom: 20px;">Create User</h3>
        <div style="margin-bottom: 15px;">
            <label for="first_name" style="display: block; margin-bottom: 5px;">First Name</label>
            <input type="text" name="first_name" id="first_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter first name" required />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="last_name" style="display: block; margin-bottom: 5px;">Last Name</label>
            <input type="text" name="last_name" id="last_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter last name" required/>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
            <input type="text" name="email" id="email" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter email" required/>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
            <input type="text" name="email" id="email" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter password" required/>
        </div>
        <div style="margin-bottom: 15px;">
        <label for="isAdmin">Admin:</label>
            <input type="checkbox" id="isAdmin" name="isAdmin">
		</div>
        <button type="submit" style="width: 100%; margin-top: 15px; padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Create User</button>
    </form>
    </div>
<?php 
require_once("../../theme/footer.php");
?>

