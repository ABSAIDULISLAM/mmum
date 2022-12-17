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
use App\Classes\Comite;
use App\Classes\Donor;

if(isset($_POST['addDonor'])){
      Donor::addDonor($_POST);
}
if(isset($_GET['comiteDelete'])){
      $id = $_GET['donorId'];
      Donor::deleteDonorById($id);
}

// sodosso add
if(isset($_POST['adddonorInfos'])){
      Donor::addDonorInfo($_POST);
}

// $message='';
// $message = $_GET['message'];
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
                  <div class="modal fade" id="addkcommitty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">দাতা তৈরী</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                              <form action="" method="POST">
                                    <div class="form-group">
                                          <div class="card">
                                                <div class="card-body">
                                                      
                                                      <div class="form-group my-2">
                                                            <label for=""> দাতার ধরন</label>
                                                            <input type="text" required name="donor_type" class="form-control mt-2">
                                                      </div>
                                                      
                                                </div>
                                          </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addDonor">সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>            
      </div>
 </div>



      <div class="col-md-6">

            <!-- modal for add sodosso  -->
            <div class="modal fade" id="sodossoCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">দাতা সদস্য তৈরী</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <form action="" method="POST">
                                          <div class="card">
                                                <div class="card-body">
                                                      <div class="form-group row">
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতা সদস্যের নাম</label>
                                                                        <input type="text" name="donor_name" required class="form-control">
                                                                  </div>
                                                            </div>
                                                            <?php
                                                            $cumityquery = mysqli_query(DB::con(), "SELECT * FROM donors");
                                                            ?>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতার ধরন</label>
                                                                        <select required name="donor_type" id="" class="form-select" >
                                                                        <?php while($comiteInfo = mysqli_fetch_assoc($cumityquery)){ ?>
                                                                              <option value="<?php echo $comiteInfo['id']?>"><?php echo $comiteInfo['donor_type']?></option>
                                                                              <?php } ?>
                                                                        </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতার মোবাইল</label>
                                                                        <input type="number" name="donor_mobile" class="form-control" required>
                                                                  </div>
                                                            </div>
                                                            <?php
                                                                  $date = Date("Y-m-d");
                                                            ?>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">অন্তর্ভূক্তি তারিখ</label>
                                                                        <input type="date" required class="form-control" name="donation_date" value="<?php echo $date; ?>">
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">চাদার পরিমান</label>
                                                                        <input type="number" required class="form-control" name="donation_amount">
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">স্টেটাস</label>
                                                                        <select required name="status" id="" class="form-select">
                                                                              <option value=""><--সিলেক্ট করুন--></option>
                                                                              <option value="1">নিয়মিত</option>
                                                                              <option value="2">অনিয়মিত</option>
                                                                        </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতার ঠিকানা</label>
                                                                        <textarea name="donor_address" id="" cols="5" rows="2" class="form-control" required></textarea>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="adddonorInfos">সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                  </div>      
            </div>


      
</div>
</div>
</div>
   
    </div>

 
                        


<div class="container">
      <div class="row">
            


      <div class="col-md-12 p-3 " style="background-color:#ebdcd5">
            <h4 class="text-center">দাতার তথ্যসমূহ</h4>
                        <div class="text-end">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#sodossoCreate" >দাতা সদস্য তৈরী করুন</button>
                        </div>
            <table class="table table-bordered table-hover" id="example">
            <thead class="text-start bg">
                  <tr>
                        <th>ক্রমিক</th>
                        <th>দাতার<br>নাম</th>
                        <th>দাতার<br>টাইপ</th>
                        <th>মোবাইল</th>
                        <th>চাদার<br>পরিমান </th>
                        <th>প্রদান<br>তারিখ</th>
                        <th>স্টেটাস</th>
                        <th>একশন</th>
                  </tr>
            </thead>
            <?php
                 $query = mysqli_query(DB::con(), "SELECT donorinfo.id, `donor_name`, donors.donor_type, `donor_mobile`, `donation_date`, `donation_amount`, `donor_address`, `donor_image`, `status`, donorinfo.created_at, `updated_at` FROM donorinfo INNER JOIN donors
                 ON donorinfo.donor_type = donors.id")
                 ?>
            <tbody class="text-start">
                  <?php
                  $i =1;
                  while($result = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $result['donor_name'] ?></td>
                        <td><?php echo $result['donor_type'] ?></td>
                        <td><?php echo $result['donor_mobile'] ?></td>
                        <td><?php echo $result['donation_date'] ?></td>
                        <td><?php echo $result['donation_amount'] ?></td>
                        <td><?php echo $result['status']==1 ? "নিয়মিত" : "আগের" ?></td>
                        <td>
                              <a href="donorInfoEdit.php?did=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" title="ইডিট"><i class="bi bi-pen"></i></a>
                              <a href="viewdonor.php?view=<?php echo $result['id'] ?>" class="btn btn-success btn-sm" title="ভিউ" ><i class="bi bi-eye"></i></a>
                              <a href="donorsendmessage.php?dmess=<?php echo $result['id'] ?>"  class="btn btn-secondary btn-sm" title="SMS" ><i class="bi bi-chat-dots"></i></a>
                        </td>
                  </tr>
                  <?php } ?>
            </tbody>
      </table>
            </div>

      
      
      <div class="col-md-12 p-3 mt-3" style="background-color:#f3e9e3">
            <h4 class="text-center">দাতার ধরনসমূহ</h4>
                        <div class="d-flex " style="justify-content:space-between;">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addkcommitty" >দাতার ধরন তৈরী করুন</button>
                        
                              <!-- <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >সেশন তৈরী করুন </button> -->
                        </div>
            <table class="table table-bordered table-hover"  id="example2">
                              <thead class="text-center bg">
                                    <tr>
                                          <th>ক্রমিক নং.</th>
                                          <th>দাতার ধরন</th>
                                          <th>একশন</th>
                                    </tr>
                              </thead>
                              <?php
                              $query = mysqli_query(DB::con(), "SELECT * FROM donors")
                              ?>
                              <tbody class="text-center">
                                    <?php
                                    $i = 1;
                                    while($result = mysqli_fetch_assoc($query)){ ?>
                                    <tr>
                                          <td><?php echo $i++ ?></td>
                                          <td><?php echo $result['donor_type'] ?></td>
                                          <td>
                                                <a href="donorEdit.php?donorId=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" titl="ইডিট"><i class="bi bi-pen"></i></a>
                                                <a href="?comiteDelete=true&&donorId=<?php echo $result['id'] ?>" onclick="return confirm('আপনি এই কমিটির ডাটা ডিলেট করতে চাচ্ছেন')" class="btn btn-danger btn-sm" title="ডিলিট"><i class="bi bi-trash"></i></a>
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
      $('#example2').DataTable();

      });
</script>



</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>