<?php
require_once('../../lib/db.php');
session_start();
if (!isset($_SESSION['user/ID'])) die('You are not authorized in this area');

$userId = $_SESSION['user/ID'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE User_ID = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
if(!$_SESSION["user/admin"]==1 && $_SESSION["user/ID"]!=$user['User_ID']) die('You can only edit your own info');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ? WHERE User_ID = ?");
    $stmt->execute([$firstName, $lastName, $email, $userId]);

    header('Location: profile.php');
    exit;
}
require_once("../../theme/header.php"); 
setTitle("Edit User Profile");
?>
	<div style="text-align: center; margin-bottom: 20px; padding: 30px">
		<a href="profile.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Return to Profile</a>
	</div>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: center; margin-bottom: 20px;">Edit Profile</h3>
        <div style="margin-bottom: 15px;">
            <label for="first_name" style="display: block; margin-bottom: 5px;">First Name</label>
            <input type="text" name="first_name" id="first_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($user['first_name']) ?>" required />
        </div>
        <div style="margin-bottom: 15px;">
            <label for="last_name" style="display: block; margin-bottom: 5px;">Last Name</label>
            <input type="text" name="last_name" id="last_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($user['last_name']) ?>" required/>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
            <input type="text" name="email" id="email" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" value="<?= htmlspecialchars($user['email']) ?>" required/>
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Save Changes</button>
    </form>
    </div>

</body>
</html>
