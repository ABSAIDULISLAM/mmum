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
use App\Classes\donor;
      
$id = $_GET['donorId'];
$query = donor::getdonorInfoById($id);
 $comiteInfo =  mysqli_fetch_assoc($query);

      
if(isset($_POST['donorUpdate'])){
      donor::updatedonorInfo($_POST, $id);
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
                                    <label for="">শ্রেনীর নাম</label>
                                    <input type="text" require value="<?php echo $comiteInfo['donor_type'] ?>" name="donor_type" class="form-control mt-2">
                              </div>
                        
                        </div>
                  </div>
            </div>
            <div class="text-end">
            <button type="submit" class="btn btn-primary" name="donorUpdate">আপডেট করুন</button>
            </div>
      </form>
</div>


</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>