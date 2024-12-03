<?php
require_once('../../lib/db.php'); 

session_start(); // Start the session

// Simulate user session for testing
$_SESSION['User_ID'] = 3; // Temporary user ID for testing
$_SESSION['email'] = 'testuser@example.com'; // Temporary email for testing

$userId = $_SESSION['User_ID'];

$stmtUser = $pdo->prepare('SELECT * FROM user WHERE User_ID = ?');
$stmtUser->execute([$userId]);
$user = $stmtUser->fetch();

$stmtProducts = $pdo->prepare('SELECT * FROM product WHERE created_by = ?');
$stmtProducts->execute([$userId]);
$products = $stmtProducts->fetchAll();

$stmtContacts = $pdo->prepare('SELECT * FROM contact WHERE user_ID = ? ');
$stmtContacts->execute([$userId]);
$contacts = $stmtContacts->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_message'])) {
    $userMessage = $_POST['user_message'];

    $stmtInsert = $pdo->prepare('INSERT INTO contact (user_ID, message, submission_date) VALUES (?, ?, ?)');
    $stmtInsert->execute([$userId, $userMessage, date('Y-m-d')]);

    header('Location: profile.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Profile - Shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="profile.php">Profile</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" href="createproduct.php">Make Your Own Product</a></li>
                </ul>
                <form class="d-flex">
                    <a href="auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"><?= ($_SESSION['email']) ?>'s Profile</h1>
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




