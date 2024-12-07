<?php
session_start();
require_once('../../lib/db.php'); 

if (!isset($_SESSION['user/ID'])) {
	header('Location: ../../lib/error/error.php');
	exit;
}


$userID = $_SESSION['user/ID'];

$stmtUser = $pdo->prepare('SELECT * FROM user WHERE User_ID = ?');
$stmtUser->execute([$userID]);
$user = $stmtUser->fetch();

$stmtProducts = $pdo->prepare('SELECT * FROM product WHERE created_by = ?');
$stmtProducts->execute([$userID]);
$products = $stmtProducts->fetchAll();

$stmtContacts = $pdo->prepare('SELECT * FROM contact WHERE user_ID = ? ');
$stmtContacts->execute([$userID]);
$contacts = $stmtContacts->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_message'])) {
    $userMessage = $_POST['user_message'];

    $stmtInsert = $pdo->prepare('INSERT INTO contact (user_ID, message, submission_date) VALUES (?, ?, ?)');
    $stmtInsert->execute([$userID, $userMessage, date('Y-m-d')]);

    header('Location: profile.php');
    exit;
}
require_once("../../theme/header.php"); 
setTitle("User Profile");
?>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"><?= ($_SESSION['user/email']) ?>'s Profile</h1>
            </div>
        </div>
    </header>
    <!-- User Products Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2>Your Listed Products</h2>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="mb-3 border p-3 rounded">
                        <h5>Product Name: <?= ($product['name']) ?></h5>
                        <p>Price: $<?= number_format($product['price'], 2) ?></p>
                        <p>Description: <?= ($product['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have not listed any products yet.</p>
            <?php endif; ?>
        </div>
    </section>
    
    <section class="py-5">
    	<div class="container px-4 px-lg-5 mt-5">
    		<h1>Manage Profile</h1>
    			<table class="table">
        			<thead>
            			<tr>
                			<th>User ID</th>
                			<th>First Name</th>
                			<th>Last Name</th>
                			<th>Email</th>
                			<th> Actions </th>
            			</tr>
       			 	</thead>
        			<tbody>
						<tr>
							<td><?= $user['User_ID'] ?></td>
							<td><?= ($user['first_name']) ?></td>
							<td><?= ($user['last_name']) ?></td>
							<td><?= ($user['email']) ?></td>
							<td>
								<a href="edituser.php?id=<?= $user['User_ID'] ?>" class="btn btn-warning">Edit</a>
								<a href="deleteuser.php?id=<?= $user['User_ID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
								<!--<a href="cart_clear.php?user_id=<?= $user['User_ID'] ?>" class="btn btn-secondary" onclick="return confirm('Are you sure you want to clear this user\'s cart?');">Clear Cart</a>
						--></td>
						</tr>
        			</tbody>
    			</table>
    		</div>
	</section>
    <!-- Contact Messages Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2>Your Contact Messages</h2>
            <?php if (count($contacts) > 0): ?>
                <?php foreach ($contacts as $contact): ?>
                    <div class="mb-3 border p-3 rounded">
                        <p><strong>Message:</strong> <?= ($contact['message']) ?></p>
                        <p><small><strong>Date:</strong> <?= ($contact['submission_date']) ?></small></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have not submitted any contact messages yet.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2>Contact Us</h2>
            <form action="profile.php" method="POST">
                <div class="mb-3">
                    <label for="user_message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="user_message" name="user_message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>




