<?php
session_start();
if(isset($_SESSION['admin_id'])==null){
      header('Location: ../index.php');
}


require_once("../vendor/autoload.php");
use App\Classes\Login;
if(isset($_GET['logout'])){
      Login::adminlogout();
}

?>

<?php  include("include/main-admin-dashboard.php") ?>


<?php  include("include/admin-dashboard-body.php") ?>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>