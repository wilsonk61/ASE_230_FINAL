<?php
require_once('../../lib/db.php');
session_start();
require_once('../../theme/header.php');
setTitle("Error");
?>
<div class="container mt-5" style="text-align: center">
    <h1>Access Denied</h1>
    <p>You do not have permission to view this page.</p>
</div>
<?php
require_once('../../theme/footer.php');
?>




