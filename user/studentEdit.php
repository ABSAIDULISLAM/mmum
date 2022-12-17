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
use App\Classes\Student;

$id = $_GET['stEdit'];

if(isset($_POST['updateStudent'])){
      Student::updateStudentInfo($_POST, $id);
}



?>

<?php  include("include/main-user-dashboard.php") ?>

<main id="main" class="main">

<?php
     $sql = "SELECT * FROM student WHERE id='$id'";
     $query = mysqli_query(DB::con(), $sql);
     $stInfo = mysqli_fetch_assoc($query);
     
     ?>
<div class="container">
      <div class="row">
            <div class="col-md-8 m-auto">
            <form action="" method="POST" name="editStudentForm">
                  <div class="form-group">
                        <div class="card">
                              <div class="card-header text-center"><h5><b>শিক্ষার্থীর ইডিট ফর্ম</b></h5></div>
                              <div class="card-body">
                                    <div class="form-group row">
                                          <div class="col-md-6">
                                                <div class="form-group my-2">
                                                      <label for="">শিক্ষার্থীর নাম</label>
                                                      <input type="text" value="<?php echo $stInfo['student_name'] ?>" required name="student_name" class="form-control mt-2">
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <?php 
                                                $query = mysqli_query(DB::con(), "SELECT * FROM class");
                                                ?>
                                                <div class="form-group my-2">
                                                      <label for="">শ্রেনীর নাম</label>
                                                      <select name="class_name" class="form-select">
                                                            <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                            <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <?php 
                                                $query = mysqli_query(DB::con(), "SELECT * FROM shakha");
                                                ?>
                                                <div class="form-group my-2">
                                                      <label for="">শাখা /গ্রুপের নাম</label>
                                                      <select  name="shakha_name" id="" class="form-select">
                                                            <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                            <option value="<?php echo $result['id'] ?>"><?php echo $result['section_name'] ?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <?php 
                                                $query = mysqli_query(DB::con(), "SELECT * FROM session");
                                                ?>
                                                <div class="form-group my-2">
                                                      <label for="">সেশন</label>
                                                      <select  name="sesion_name" id="" class="form-select">
                                                            <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                            <option value="<?php echo $result['id'] ?>"><?php echo $result['session'] ?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group my-2">
                                                      <label for="">রোল নং</label>
                                                      <input type="text" value="<?php echo $stInfo['roll'] ?>" required name="roll" class="form-control mt-2">
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                                <div class="form-group my-2">
                                                      <label for="">মোবাইল</label>
                                                      <input type="text" value="<?php echo $stInfo['mobile'] ?>" required name="mobile" class="form-control mt-2">
                                                </div>
                                          </div>
                                          <div class="col-md-12">
                                                <div class="form-group my-2">
                                                      <label class="form-label col-md-2" for=""><b>স্টেটাস :</b></label>
                                                      <div class="col-md-10" Required>
                                                            <input type="radio" name="status" <?php  if($stInfo['status']==1){echo 'checked';} ?> value="1" > নিয়মিত শিক্ষার্থী  
                                                            <input type="radio" name="status" <?php  if($stInfo['status']==0){echo 'checked';} ?> value="0"> আগের শিক্ষার্থী
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <div class="text-end m-5">
                              <button type="submit" class="btn btn-primary" name="updateStudent">সংরক্ষন করুন</button>
                              </div>
                        </div>
                  </div>
            
            </form>
            </div>
      </div>
</div>



<script>
      document.forms['editStudentForm'].elements['class_name'].value = '<?php echo $stInfo['class_id']?>';
      document.forms['editStudentForm'].elements['shakha_name'].value = '<?php echo $stInfo['shakha_id']?>';
      document.forms['editStudentForm'].elements['sesion_name'].value = '<?php echo $stInfo['session_id']?>';

</script>
</main>

<!-- ======= footer ======= -->
<?php  include("include/user-footer.php") ?>