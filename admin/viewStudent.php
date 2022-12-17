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
// ==--login/ logout section==


use App\Classes\DB;

use App\Classes\Donor;

$id = $_GET['view'];


      $sql = "SELECT student.id, `student_name`, class.class_name, shakha.section_name, session.session, `roll`, `mobile`, student.created_at, `updated_at`, `student_image`,  status FROM student INNER JOIN class ON student.class_id = class.id 
      INNER JOIN shakha ON student.shakha_id = shakha.id
      INNER JOIN session ON student.session_id = session.id WHERE student.id= '$id'";
      $query = mysqli_query(DB::con(), $sql);
      $result = mysqli_fetch_assoc($query);
      // echo "<pre>";
      // print_r($result);
      // exit(); 


?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">


<div class="container">
      <div class="row">
            <div class="col-md-12">
                  <div class="card">
                        <div class="card-header text-center p-3"><h4><strong>শিক্ষার্থী ভিউ</strong></h4></div>
                        <div class="card-body">
                              <table class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <td><b>শিক্ষার্থীর নাম</b></td>
                                                <td><?php echo $result['student_name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>শ্রেনীর নাম</b></td>
                                                <td><?php echo $result['class_name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>শাখার নাম</b></td>
                                                <td><?php echo $result['section_name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>রোল নং</b></td>
                                                <td><?php echo $result['roll'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>সেশন</b></td>
                                                <td><?php echo $result['session'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>মোবাইল</b></td>
                                                <td><?php echo $result['mobile'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>শিক্ষার্থী ছবি</b></td>
                                                <td><img src="<?php echo $result['student_image'] ?>" alt=""></td>
                                          </tr>
                                          <tr>
                                                <td><b>স্টেটাস</b></td>
                                                <td><?php echo $result['status']==1 ? "নিয়মিত" : "অনিয়মিত" ?></td>
                                          </tr>
                                          
                                    </thead>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>






</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>