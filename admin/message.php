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

$id = $_GET['mess'];



if(isset($_POST['send'])){
     $mobile = '+88'.$_POST['mobile'];
     $mess = $_POST['messtext'];
     $stname = $_POST['student_name'];

     $to = "$mobile";
     $token = "87991921371671024097ac42cd5523ff3df1c17197241b8bae52";
     $message = "$mess";
     
     $url = "http://api.greenweb.com.bd/api.php?json";
     
     
     $data= array(
     'to'=>"$to",
     'message'=>"$message",
     'token'=>"$token"
     ); 
     $ch = curl_init(); 
     curl_setopt($ch, CURLOPT_URL,$url);
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     curl_setopt($ch, CURLOPT_ENCODING, '');
     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $smsresult = curl_exec($ch);
     
     //Result
//      echo $smsresult;
     if($smsresult==true){
            $query = "INSERT INTO studentmessage(student_name, mobile, messtext) VALUES('$stname', '$mobile', '$mess')";
                  if($query){
                        header("Location:manage-student.php?message=<script>alert('মেসেজ সফলভাবে প্রেরিত হয়েছে')</script>");
                  }
     
     }else{
      echo "<script>alert('মেসেজ প্রেরিত হয়নি')</script>";
     }
     
     //Error Display
     echo curl_error($ch);

}







?>

<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">


<?php
$query = mysqli_query(DB::con(), "SELECT * FROM student WHERE id = '$id'");
$result = mysqli_fetch_assoc($query);


?>

<div class="container">
      <div class="row">
            <div class="col-md-8 m-auto ">
                  <form action="" method="post">
                        <div class="card p-3">
                              <div class="card-header text-center my-3"><h4><b>এসএমএস ফর্ম</b></h4></div>
                              <div class="card-body">
                                    <div class="form-group my-2">
                                          <label for="">শিক্ষার্থীর নাম </label>
                                          <input readonly type="text" name="student_name" value="<?php echo $result['student_name'] ?>" class="form-control my-2">
                                    </div>
                                    <div class="form-group my-2">
                                          <label for="">শিক্ষার্থীর মোবাইল </label>
                                          <input readonly type="number" name="mobile" value="<?php echo $result['mobile'] ?>" class="form-control my-2">
                                    </div>
                                    <div class="form-group my-3 ">
                                          <label for="">বার্তা লিখুন</label>
                                          <textarea required name="messtext" id="" cols="4" rows="10" class="form-control my-2" placeholder="এখানে বার্তা লিখুন..."></textarea>
                                    </div>
                                    <div class="form-group text-end ">
                                          <button class="btn btn-primary my-3"  onclick="return confirm('আপনি কি শিক্ষার্থীকে এই মেসেজটি পাঠাতে চাচ্ছেন ??')" name="send">বার্তা প্রেরন করুন</button>
                                    </div>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
</div>








</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>