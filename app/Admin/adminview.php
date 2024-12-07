<?php
require_once('../../lib/db.php');
session_start();
if (!isset($_SESSION['user/ID']) || $_SESSION["user/admin"]!=1) {
	header('Location: ../../lib/error/error.php');
	exit;

}

$stmtProducts = $pdo->prepare("SELECT * FROM product");
$stmtProducts->execute();
$products = $stmtProducts->fetchAll();

$stmtContacts = $pdo->prepare("SELECT * FROM contact");
$stmtContacts->execute();
$contacts = $stmtContacts->fetchAll();

$stmtUsers = $pdo->prepare("SELECT * FROM user");
$stmtUsers->execute();
$users = $stmtUsers->fetchAll();

require_once("../../theme/header.php"); 
setTitle("Admin Page");
?>

<div class="container mt-5">
    <h1>Manage Products</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['product_ID'] ?></td>
                    <td><?= ($product['name']) ?></td>
                    <td>$<?= number_format($product['price'], 2) ?></td>
                    <td>
                        <a href="../Products/edit.php?id=<?= $product['product_ID'] ?>" class="btn btn-warning">Edit</a>
                        <a href="../Products/delete.php?id=<?= $product['product_ID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../Products/createproduct.php" class="btn btn-success">Create New Product</a>
</div>

<div class="container mt-5">
    <h1>Manage Contact Messages</h1>
    <?php if (empty($contacts)): ?>
        <p>No contact messages found.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Contact ID</th>
                    <th>User ID</th>
                    <th>Message</th>
                    <th>Submission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact['Contact_ID'] ?></td>
                        <td><?= $contact['User_ID'] ?></td>
                        <td><?= ($contact['message']) ?></td>
                        <td><?= ($contact['submission_date']) ?></td>
                        <td>
                            <a href="contactdelete.php?id=<?= $contact['Contact_ID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="container mt-5">
    <h1>Manage Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
				<tr>
					<td><?= $user['User_ID'] ?></td>
					<td><?= ($user['first_name']) ?></td>
					<td><?= ($user['last_name']) ?></td>
					<td><?= ($user['email']) ?></td>
					<td><?= $user['isAdmin'] ? 'Admin' : 'User' ?></td>
					<td>
						<a href="edituser.php?id=<?= $user['User_ID'] ?>" class="btn btn-warning">Edit</a>
						<a href="deleteuser.php?id=<?= $user['User_ID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
						<a href="admin_clear_cart.php?user_id=<?= $user['User_ID'] ?>" class="btn btn-secondary" onclick="return confirm('Are you sure you want to clear this user\'s cart?');">Clear Cart</a>
					</td>
				</tr>
			<?php endforeach; ?>

        </tbody>
    </table>
	<a href="createuser.php" class="btn btn-success">Create New User</a>
</div>
<?php
require_once("../../theme/footer.php");
?>
