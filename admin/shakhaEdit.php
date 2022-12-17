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
      
$id = $_GET['shakhaId'];

if(isset($_POST['updateShaka'])){
      AddClasses::updateShakaInfo($_POST, $id);
}





?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">

<?php
      $query = mysqli_query(DB::con(), "SELECT * FROM shakha WHERE id = '$id'");
      $shakhaInfo = mysqli_fetch_assoc($query);
?>

<div class="col-md-8 m-auto">
      <form action="" method="POST" name="editShakhaForm">
          <div class="form-group">
                <div class="card">
                      <div class="card-body">
                              <?php
                              $query = mysqli_query(DB::con(), "SELECT * FROM class");
                              ?>
                            <div class="form-group my-2">
                                  <label for="">শাখার নাম</label>
                                  <select id="" name="class_name" class="form-select">
                                    <?php while( $classInfo = mysqli_fetch_assoc($query)){ ?>
                                    <option value="<?php echo $classInfo['id'] ?>"><?php echo $classInfo['class_name'] ?></option>
                                    <?php } ?>
                                  </select>
                            </div>
                            <div class="form-group my-2">
                                  <label for="">শাখার নাম</label>
                                  <input type="text" value="<?php echo $shakhaInfo['section_name'] ?>" required name="section_name" class="form-control mt-2">
                            </div>
                      
                      </div>
                </div>
          </div>
    <div class="text-end">
    <button type="submit" class="btn btn-primary" name="updateShaka" >সংরক্ষন করুন</button>
    </div>
    </form>
</div>



<script>
     document.forms['editShakhaForm'].elements['class_name'].value='<?php echo $shakhaInfo['class_id'] ?>';
</script>

</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>