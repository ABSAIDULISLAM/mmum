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
      
if(isset($_POST['addClass'])){
      AddClasses::addClassName($_POST);
}
if(isset($_POST['addShakha'])){
      AddClasses::addShakhaName($_POST);
}

// classdelete
if(isset($_GET['classdelete'])){
      $id = $_GET['classId'];
      AddClasses::deleteclassInfo($id);
}
// shakhaDelete
if(isset($_GET['shakhaDelete'])){
      $id = $_GET['shakhaId'];
      AddClasses::deleteShakhaInfo($id);
}



?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
      


      <div class="container">
            <div class="row">
                  <div class="col-md-6">
                        
                        <!-- modal for add class  -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">শ্রেনী তৈরী</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              
                              <div class="modal-body">
                                    <form action="" method="POST">
                                          <div class="form-group">
                                                <div class="card">
                                                      <div class="card-body">
                                                            
                                                            <div class="form-group my-2">
                                                                  <label for="">শ্রেনীর নাম</label>
                                                                  <input type="text" required name="class_name" class="form-control mt-2">
                                                            </div>
                                                      
                                                      </div>
                                                </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addClass" >সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                        </div>
                        </div>


                       
                  </div>
            </div>



      <div class="col-md-6">

            <!-- modal for add class  -->
            <div class="modal fade" id="sectioncrate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">শাখা তৈরী</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <form action="" method="POST">
                                          <div class="form-group">
                                                <div class="card">
                                                      <div class="card-body">
                                                            <?php 
                                                            $query = mysqli_query(DB::con(), "SELECT * FROM class");
                                                            ?>
                                                            <div class="form-group my-2">
                                                                  <label for=""> নাম</label>
                                                                  <select required name="class_name" id="" class="form-select">
                                                                        <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                                        <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>
                                                                        <?php } ?>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group my-2">
                                                                  <label for="">শাখার নাম</label>
                                                                  <input type="text"  required name="section_name" class="form-control mt-2">
                                                            </div>
                                                      
                                                      </div>
                                                </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addShakha" >সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                  </div>      
            </div>


      
</div>
</div>
</div>
   




<div class="container">
      <div class="row">
            <div class="col-md-6 p-3" style="background-color:#f3e9e3">
            <h4 class="text-center">শ্রেনীর তথ্যসমূহ</h4>
                        <div class="d-flex " style="justify-content:space-between;">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >শ্রেনী তৈরী করুন</button>
                        
                              <!-- <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >সেশন তৈরী করুন </button> -->
                        </div>
            <table class="table table-bordered table-hover"  id="example">
                              <thead class="text-center bg">
                                    <tr>
                                          <th>ক্রমিক</th>
                                          <th>শ্রেনী </th>
                                          <th>একশন</th>
                                    </tr>
                              </thead>
                              <?php
                              $query = mysqli_query(DB::con(), "SELECT * FROM class")
                              ?>
                              <tbody class="text-center">
                                    <?php
                                    $i = 1;
                                    while($result = mysqli_fetch_assoc($query)){ ?>
                                    <tr>
                                          <td><?php echo $i++ ?></td>
                                          <td><?php echo $result['class_name'] ?></td>
                                          <td>
                                                <a href="classEdit.php?classId=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" titl="ইডিট"><i class="bi bi-pen"></i></a>
                                                <a href="?classdelete=true&&classId=<?php echo $result['id'] ?>" onclick="return confirm('আপনি এই ডাটা ডিলেট করতে চাচ্ছেন')" class="btn btn-danger btn-sm" title="ডিলিট"><i class="bi bi-trash"></i></a>
                                          </td>
                                    </tr>
                                    <?php } ?>
                              </tbody>
                        </table>
                                                                              
            </div>



            <div class="col-md-6 p-3" style="background-color:#e2dcdc">
            <h4 class="text-center">শাখার তথ্যসমূহ</h4>
                        <div class="text-end">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#sectioncrate" >শাখা তৈরী করুন</button>
                        </div>
            <table class="table table-bordered table-hover" id="example2">
            <thead class="text-start bg">
                  <tr>
                        <th>ক্রমিক</th>
                        <th>শ্রেনী</th>
                        <th>শাখা</th>
                        <th>একশন</th>
                  </tr>
            </thead>
            <?php
                 $query = mysqli_query(DB::con(), "SELECT shakha.id, class.class_name, `section_name`, shakha.created_at FROM `shakha` INNER JOIN class ON
                 shakha.class_id = class.id")
                 ?>
            <tbody class="text-start">
                  <?php
                  $i =1;
                  while($result = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $result['class_name'] ?></td>
                        <td><?php echo $result['section_name'] ?></td>
                        <td>
                              <a href="shakhaEdit.php?shakhaId=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" title="ইডিট"><i class="bi bi-pen"></i></a>
                              <a href="?shakhaDelete=true&&shakhaId=<?php echo $result['id'] ?>" onclick="return confirm('আপনি এই ডাটা ডিলেট করতে চাচ্ছেন')" class="btn btn-danger btn-sm" title="ডিলিট" ><i class="bi bi-trash"></i></a>
                        </td>
                  </tr>
                  <?php } ?>
            </tbody>
      </table>
            </div>
      </div>
</div>



<style>
      .bg{
            background-color:#dedede;
      }
</style>


<script>
      $(document).ready(function () {
      $('#example').DataTable();
      });
      $(document).ready(function () {
      $('#example2').DataTable();
      });
</script>



</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>