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

if(isset($_POST['sendAllstudents'])){
     $messtext = $_POST['messtext'];


      $query = mysqli_query(DB::con(), "SELECT mobile FROM student WHERE status = 1");
      $resl = mysqli_fetch_assoc($query);
      // echo "<pre>";
      // print_r($resl);
      // exit();

      $to="";
      while($row = mysqli_fetch_assoc($query)){
            $number = $row['mobile'];
            $allnumber = "$number,$to";

      }

     $token = "87991921371671024097ac42cd5523ff3df1c17197241b8bae52";
     $message = "$messtext";
     $to = "$allnumber";
     
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
     echo $smsresult;
     if($smsresult==true){
      $query = mysqli_query(DB::con(), "INSERT INTO studentallmessage (messtext) VALUES('$messtext')");
            if($message){
                  $message = header("Location:manage-student.php");
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


<div class="container">
      <div class="row">
            <div class="col-md-8 m-auto ">
                  <form action="" method="post">
                        <div class="card p-3">
                              <div class="card-header text-center my-3"><h4><b>এসএমএস ফর্ম</b></h4></div>
                              <div class="card-body">
                                    <!-- <div class="form-group my-2">
                                          <label for="">শিক্ষার্থীর মোবাইল</label>
                                          <input readonly type="number" name="mobile" value="" class="form-control my-2">
                                    </div> -->
                                    <div class="form-group my-3 ">
                                          <label for="">বার্তা লিখুন</label>
                                          <textarea required name="messtext" id="" cols="4" rows="10" class="form-control my-2" placeholder="এখানে বার্তা লিখুন..."></textarea>
                                    </div>
                                    <div class="form-group text-end ">
                                          <button class="btn btn-primary my-3" onclick="return confirm('আপনি কি সকল শিক্ষার্থীদেরকে এই মেসেজটি পাঠাতে চাচ্ছেন ?  ')" name="sendAllstudents">বার্তা প্রেরন করুন</button>
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