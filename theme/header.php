<?php
function setTitle($title){
	loadHeader($title);
}

function loadHeader($title) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>  
 <!--Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../../app/Users/profile.php">Profile</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../app/Products/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../app/Products/about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../app/Products/createproduct.php">Make Your Own Product</a></li>
                        <?php if(isset($_SESSION["user/admin"]) && $_SESSION["user/admin"]) { ?>
                        	<li class="nav-item"><a class="nav-link active" aria-current="page" href="../../app/Admin/adminview.php">Admin Dashboard</a></li>
                    	<?php } ?>
                    </ul>
                    <form class="d-flex">
                    <?php if(isset($_SESSION["user/ID"])) { ?>
                		<a href="../../lib/auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
                		<a href="../../app/Products/cart.php" class="btn btn-outline-dark">Cart</a>
					<?php }
            		else { ?>
            			<a href="../../lib/auth/signup.php" class="btn btn-outline-dark">Sign Up</a>
                		<a href="../../lib/auth/signin.php" class="btn btn-outline-dark">Sign In</a>
            		<?php } ?> 
            		</form>
                </div>
            </div>
        </nav>
 <!--End Navigation-->
<?php
 }
?>