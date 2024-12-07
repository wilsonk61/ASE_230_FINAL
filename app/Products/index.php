<?php 
require_once('../../lib/db.php'); // Include database connection file
session_start();
require_once("../../theme/header.php"); 
setTitle('HomePage');
?>
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
            $stmt = $pdo->prepare("SELECT * FROM product");
            $stmt->execute();
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
                            <?php if(isset($_SESSION['user/ID']) && ($_SESSION["user/admin"]==1 || $_SESSION["user/ID"]==$product["created_by"])) { ?>
                            <br>
                            <div class="text-center">
                                <a class="btn btn-outline-warning mt-auto" href="edit.php?id=<?php echo $product['product_ID']; ?>">Edit</a>
                            </div>
                            <br>
                            <div class="text-center">
                                <a class="btn btn-outline-danger mt-auto" href="delete.php?id=<?php echo $product['product_ID']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<?php 
require_once("../../theme/footer.php");
?>
