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

$id = $_GET['did'];
$dresult = Donor::getdonorInfo($id);


if(isset($_POST['updateDonor'])){
      Donor::updateDonorInof($_POST, $id);
} 



?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">


<div class="container">
      <div class="row">
            <div class="col-md-10 m-auto">
                  <form action="" method="POST" name="editDonorForm">
                                          <div class="card">
                                                <div class="card-header text-center py-3"><h4>আপডেট দাতা সদস্যের </h4></div>
                                                <div class="card-body">
                                                      <div class="form-group row">
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতা সদস্যের নাম</label>
                                                                        <input type="text" value="<?php echo $dresult['donor_name'] ?>" name="donor_name" required class="form-control">
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
                                                                        <input type="number" name="donor_mobile" value="<?php echo $dresult['donor_mobile'] ?>" class="form-control" required>
                                                                  </div>
                                                            </div>
                                                            <?php
                                                                  $date = Date("Y-m-d");
                                                            ?>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">অন্তর্ভূক্তি তারিখ</label>
                                                                        <input type="date" required class="form-control" name="donation_date" value="<?php echo $dresult['donation_date'] ?>">
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">চাদার পরিমান</label>
                                                                        <input type="number" required class="form-control" name="donation_amount" value="<?php echo $dresult['donation_amount'] ?>">
                                                                  </div>
                                                            </div>

                                                                  <div class="col-md-6">
                                                                        <div class="form-group my-2">
                                                                              <label class="form-label" for=""><b>স্টেটাস :</b></label>
                                                                              <div class="" Required>
                                                                                    <input type="radio" name="status" <?php  if($dresult['status']==1){echo 'checked';} ?> value="1" > নিয়মিত      
                                                                                    <input type="radio" name="status" <?php  if($dresult ['status']==2){echo 'checked';} ?> value="2">  অনিয়মিত
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            <div class="col-md-12">
                                                                  <div class="form-group py-2">
                                                                        <label for="">দাতার ঠিকানা</label>
                                                                        <textarea name="donor_address" id="" cols="10" rows="5" class="form-control" required><?php echo $dresult['donor_address'] ?></textarea>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                </div>
                                                <div class="text-end m-5">
                                                <button type="submit" class="btn btn-primary" name="updateDonor">আপডেট করুন</button>
                                                </div>
                                          </div>
                  </form>

            </div>
      </div>
</div>





<script>
      document.forms['editDonorForm'].elements['donor_type'].value = '<?php echo $result['donor_type']?>';

</script>
</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>