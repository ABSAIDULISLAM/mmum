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
use App\Classes\Comite;
use App\Classes\DB;
use App\Classes\Student;

$id = $_GET['sodossoId'];



if(isset($_POST['updatesodosso'])){
      Comite::updatesodossoInfo($_POST, $id);
} 





?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">




<div class="container">
      <div class="row">
            <div class="col-md-10 m-auto">
            <?php
            $sql = "SELECT * FROM sodosso WHERE id = '$id'";
            $query = mysqli_query(DB::con(), $sql);
            $sodossoInfo = mysqli_fetch_assoc($query);
            
            ?>
            <form action="" method="POST" name="editsodossoForm">
                              <div class="card">
                              <div class="card-header text-center"><h5><b>সদস্য ইডিট ফর্ম</b></h5></div>
                                 <div class="card-body">
                                       <div class="form-group row">
                                             <div class="col-md-6">
                                                   <div class="form-group py-2">
                                                         <label for="">সদস্যের নাম</label>
                                                         <input type="text" value="<?php echo $sodossoInfo['sodosso_name'] ?>" name="sodosso_name" required class="form-control">
                                                   </div>
                                             </div>
                                             <?php
                                             $cumityquery = mysqli_query(DB::con(), "SELECT * FROM comite");
                                             ?>
                                             <div class="col-md-6">
                                                   <div class="form-group py-2">
                                                         <label for="">কমিটির নাম</label>
                                                         <select name="comite_name" id="" class="form-select" >
                                                         <?php while($comiteInfo = mysqli_fetch_assoc($cumityquery)){ ?>
                                                               <option value="<?php echo $comiteInfo['id']?>"><?php echo $comiteInfo['comite_name']?></option>
                                                               <?php } ?>
                                                         </select>
                                                   </div>
                                             </div>
                                             <div class="col-md-6">
                                                   <div class="form-group py-2">
                                                         <label for="">কমিটির মোবাইল</label>
                                                         <input type="number" value="<?php echo $sodossoInfo['sodosso_mobile'] ?>" name="sodosso_mobile" class="form-control" required>
                                                   </div>
                                             </div>
                                             <?php
                                             $query = mysqli_query(DB::con(), "SELECT * FROM session");
                                             ?>
                                             <div class="col-md-6">
                                                   <div class="form-group py-2">
                                                         <label for="">সেশন</label>
                                                         <select name="comite_session" id="" class="form-select">
                                                         <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                         <option value="<?php  echo $result['id']?>"><?php  echo $result['session']?></option>
                                                         <?php } ?>
                                                         </select>
                                                   </div>
                                             </div>
                                             <div class="col-md-12">
                                                   <div class="form-group py-2">
                                                         <label for="">কমিটির ঠিকানা</label>
                                                         <textarea name="sodosso_address" id="" cols="5" rows="2" class="form-control"><?php echo $sodossoInfo['sodosso_address'] ?></textarea>
                                                   </div>
                                             </div>
                                                <div class="form-group my-2">
                                                      <label class="form-label col-md-2" for=""><b>স্টেটাস :</b></label>
                                                      <div class="col-md-10 d-flex" Required>
                                                            <input type="radio" name="status" <?php  if($sodossoInfo['status']==1){echo 'checked';} ?> value="1" >নিয়মিত কমিটি    
                                                            <input type="radio" name="status" <?php  if($sodossoInfo ['status']==0){echo 'checked';} ?> value="0"> আগের কমিটি
                                                      </div>
                                                </div>
                                       </div>
                                          <div class="text-end">
                                          <button type="submit" class="btn btn-primary" name="updatesodosso">সংরক্ষন করুন</button>
                                          </div>
                                 </div>
                              </div>
                              
                              </form>

            </div>
      </div>
</div>





<script>
      document.forms['editsodossoForm'].elements['comite_name'].value = '<?php echo $sodossoInfo['comite_id']?>';
      document.forms['editsodossoForm'].elements['comite_session'].value = '<?php echo $sodossoInfo['session_id']?>';

</script>
</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>