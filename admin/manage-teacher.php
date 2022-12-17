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

// ==--login/ logout section==-
use App\Classes\AddClasses;
use App\Classes\DB;
use App\Classes\Student;
use App\Classes\Comite;
use App\Classes\Donor;


?>


<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">










</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>