<?php
session_start();
if(isset($_SESSION['user_id'])==null){
      header('Location: ../index.php');
}


require_once("../vendor/autoload.php");
use App\Classes\Login;
if(isset($_GET['logout'])){
      Login::userlogout();
}

?>

<?php  include("include/main-user-dashboard.php") ?>


<?php  include("include/user-dashboard-body.php") ?>

<!-- ======= footer ======= -->
<?php  include("include/user-footer.php") ?>
