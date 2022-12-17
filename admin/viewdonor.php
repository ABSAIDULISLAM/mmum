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


      $query = mysqli_query(DB::con(), "SELECT donorinfo.id, `donor_name`, donors.donor_type, `donor_mobile`, `donation_date`, `donation_amount`, `donor_address`, `donor_image`, `status`, donorinfo.created_at, `updated_at` FROM donorinfo INNER JOIN donors
      ON donorinfo.donor_type = donors.id WHERE donorinfo.id = '$id' ");
      // $query = mysqli_query(DB::con(), $sql);
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
                        <div class="card-header text-center p-3"><h4><strong>দাতা ভিউ</strong></h4></div>
                        <div class="card-body">
                              <table class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <td><b>দাতার নাম</b></td>
                                                <td><?php echo $result['donor_name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দাতার ধরন</b></td>
                                                <td><?php echo $result['donor_type'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দাতার মোবাইল</b></td>
                                                <td><?php echo $result['donor_mobile'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দানের পরিমান</b></td>
                                                <td><?php echo $result['donation_amount']." ৳" ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দান প্রদানের তারিখ</b></td>
                                                <td><?php echo $result['donation_date'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দাতার ঠিকানা</b></td>
                                                <td><?php echo $result['donor_address'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>দাতার ছবি</b></td>
                                                <td><img src="<?php echo $result['donor_image'] ?>" alt=""></td>
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