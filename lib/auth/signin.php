<?php
session_start();
require_once("../../theme/header.php");
setTitle("Sign In");

?> 
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
    				<?php if (isset($_SESSION["error_message"])) { ?>
        				<div style="color: red; font-weight: bold;">
            			<?php echo $_SESSION["error_message"] ?> 
        			</div>
       				<?php unset($_SESSION["error_message"]);
   						} ?>
                        <form action="auth.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>    
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="action" value="Sign In" class="btn btn-primary">
                                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                            </div>
                        	<p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once("../../theme/footer.php");
?>