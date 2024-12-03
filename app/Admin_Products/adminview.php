<?php
require_once('../../lib/db.php'); 

$stmtProducts = $pdo->query("SELECT * FROM product");
$products = $stmtProducts->fetchAll();

$stmtContacts = $pdo->query("SELECT * FROM contact");
$contacts = $stmtContacts->fetchAll();

$stmtUsers = $pdo->query("SELECT * FROM user");
$users = $stmtUsers->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="adminview.php">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link active" href="createproduct.php">Make Your Own Product</a></li>
            </ul>
            <form class="d-flex">
                <a href="../auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
            </form>
        </div>
    </div>
</nav>

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
                        <a href="edit.php?id=<?= $product['product_ID'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $product['product_ID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="createproduct.php" class="btn btn-success">Create New Product</a>
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
                        <td><?= $contact['user_ID'] ?></td>
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
</body>
</html>
