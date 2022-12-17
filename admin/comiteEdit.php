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
use App\Classes\Comite;
      
$id = $_GET['comiteId'];
$query = Comite::getComiteInfoById($id);
 $comiteInfo =  mysqli_fetch_assoc($query);


if(isset($_POST['comiteUpdate'])){
      Comite::updateCometeInfo($_POST, $id);
}





?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">

<div class="col-md-8 m-auto">
<form action="" method="POST">
            <div class="form-group">
                  <div class="card">
                        <div class="card-body">
                              <div class="form-group my-2">
                                    <label for="">কমিটির নাম</label>
                                    <input type="text" require value="<?php echo $comiteInfo['comite_name'] ?>" name="comite_name" class="form-control mt-2">
                              </div>
                        
                        </div>
                  </div>
            </div>
            <div class="text-end">
            <button type="submit" class="btn btn-primary" name="comiteUpdate">আপডেট করুন</button>
            </div>
      </form>
</div>


</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>