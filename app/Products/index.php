<?php 
require_once('../../lib/db.php'); // Include database connection file



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="createproduct.php">Make Your Own Product</a></li>
                    </ul>
                    <form class="d-flex">
                        <a href="auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
						<a href="cart.php" class="btn btn-outline-dark">cart</a>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    // Fetch products from the database
                    $stmt = $pdo->query("SELECT * FROM product");
                    $products = $stmt->fetchAll();

                    foreach ($products as $product) {
                    ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
								<?php if (!empty($product['ImageURL'])): ?>
									<img class="card-img-top" src="<?php echo ($product['ImageURL']); ?>" alt="Product Image" />
								<?php endif; ?>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo ($product['name']); ?></h5>
                                        <!-- Product price-->
                                        <?php echo "$", number_format($product['price']); ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="detail.php?id=<?php echo $product['product_ID']; ?>">Details</a>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <a class="btn btn-outline-warning mt-auto" href="edit.php?id=<?php echo $product['product_ID']; ?>">Edit</a>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <a class="btn btn-outline-danger mt-auto" href="delete.php?id=<?php echo $product['product_ID']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
    </body>
</html>
