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

// ==--login/ logout section==-
use App\Classes\AddClasses;
use App\Classes\DB;
      
$id = $_GET['classId'];
$query = AddClasses::getClassInfoById($id);
 $classInfo =  mysqli_fetch_assoc($query);


if(isset($_POST['updateClass'])){
      AddClasses::updateClassInfo($_POST, $id);
}





?>

<?php  include("include/main-user-dashboard.php") ?>

<main id="main" class="main">

<div class="col-md-8 m-auto">
<form action="" method="POST">
            <div class="form-group">
                  <div class="card">
                        <div class="card-body">
                              <div class="form-group my-2">
                                    <label for="">শ্রেনীর নাম</label>
                                    <input type="text" require value="<?php echo $classInfo['class_name'] ?>" name="class_name" class="form-control mt-2">
                              </div>
                        
                        </div>
                  </div>
            </div>
            <div class="text-end">
            <button type="submit" class="btn btn-primary" name="updateClass">আপডেট করুন</button>
            </div>
      </form>
</div>


</main>

<!-- ======= footer ======= -->
<?php  include("include/user-footer.php") ?>