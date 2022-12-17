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

if(isset($_POST['addStudent'])){
      Student::addStudentInfo($_POST);
}

// update message----
$mes='';
// $mes = $_GET['message'];

?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
      

<div class="container">
      <div class="row">
            <div class="col-md-12 p-4" style="background-color:#f3e9e3">
                  
                        <div class="d-flex" style="justify-content:space-between">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addsession" >সেশন তৈর করুন</button>

                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#studentCreate" >শিক্ষার্থীর যোগ করুন</button>
                        </div>
                        <h4 class="text-center py-3">শিক্ষার্থীর তথ্যসমূহ</h4>
                              <p class="text-danger"><?php echo $mes; ?></p>
            
            <table class="table table-bordered table-hover display my-2" id="example" style="100%">
                  <thead class="bg my-2">
                        <tr>
                              <th>ক্র.</th>
                              <th>শিক্ষার্থীর<br>নাম</th>
                              <th>শ্রেনী</th>
                              <th>শাখা</th>
                              <th>সেশন</th>
                              <th>রোল</th>
                              <th>মোবাইল</th>
                              <th>স্টেটাস</th>
                              <th>একশন</th>

                        </tr>
                  </thead>
                  <?php
                  $sql = "SELECT student.id, `student_name`, class.class_name, shakha.section_name, session.session, `roll`, `mobile`, student.created_at, `updated_at`, status FROM student INNER JOIN class ON student.class_id = class.id 
                  INNER JOIN shakha ON student.shakha_id = shakha.id
                  INNER JOIN session ON student.session_id = session.id";
                  $query = mysqli_query(DB::con(), $sql);
                  
                  ?>
                  <tbody>
                        <?php 
                        $i = 1;
                        while($studentInfo = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                              <td><?php echo $i++ ?></td>
                              <td><?php echo $studentInfo['student_name'] ?></td>
                              <td><?php echo $studentInfo['class_name'] ?></td>
                              <td><?php echo $studentInfo['section_name'] ?></td>
                              <td><?php echo $studentInfo['session'] ?></td>
                              <td><?php echo $studentInfo['roll'] ?></td>
                              <td><?php echo $studentInfo['mobile'] ?></td>
                              <td><?php echo $studentInfo['status']==1 ? "নিয়মিত" : "আগের" ?></td>
                              <td>
                                    <a href="studentEdit.php?stEdit=<?php echo $studentInfo['id'] ?>" class="btn btn-primary btn-sm" title="ইডিট"><i class="bi bi-pen"></i></a>
                                    <a href="" class="btn btn-success btn-sm " title="ভিউ"><i class="bi bi-eye"></i></a>
                                    <a href="message.php?mess=<?php echo $studentInfo['id'] ?>" class="btn btn-secondary btn-sm " title="এসএমএস"><i class="bi bi-chat-dots"></i></a>
                              </td>
                        </tr>
                        <?php } ?>
                  </tbody>
            </table>

            </div>
      </div>
</div>

<script>
      $(document).ready(function () {
      $('#example').DataTable();
      });
</script>




<!-- modal for add student  -->
<div class="modal fade" id="studentCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">শিক্ষার্থী তৈরী</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <form action="" method="POST">
                                          <div class="form-group">
                                                <div class="card">
                                                      <div class="card-body">
                                                            <div class="form-group my-2">
                                                                  <label for="">শিক্ষার্থীর নাম</label>
                                                                  <input type="text" required name="student_name" class="form-control mt-2">
                                                            </div>
                                                            <?php 
                                                            $query = mysqli_query(DB::con(), "SELECT * FROM class");
                                                            ?>
                                                            <div class="form-group my-2">
                                                                  <label for="">শ্রেনীর নাম</label>
                                                                  <select  name="class_name" id="" class="form-select">
                                                                        <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                                        <option value="<?php echo $result['id'] ?>"><?php echo $result['class_name'] ?></option>
                                                                        <?php } ?>
                                                                  </select>
                                                            </div>
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
                                                            <div class="form-group my-2">
                                                                  <label for="">রোল নং</label>
                                                                  <input type="text" required name="roll" class="form-control mt-2">
                                                            </div>
                                                            <div class="form-group my-2">
                                                                  <label for="">মোবাইল</label>
                                                                  <input type="text" required name="mobile" class="form-control mt-2">
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addStudent">সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                  </div>      
            </div>

<style>
      .bg{
            background-color:#dedede;
      }
</style>






</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>