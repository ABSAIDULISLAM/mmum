<?php
session_start();

if(isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])){
      header("Location: admin/dashboard.php");
}
require_once("vendor/autoload.php");
use App\Classes\Login;
$message="";
if(isset($_POST['login'])){
      $message = Login::LogincCheck($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="./assets/bootstrap.min.css">
</head>
<body>
      <section class="about py-4 ">
            <div class="container">
                  <div class="row">
                        <h3 class="text-dark text-center pt-4"><b>মাদানীনগর মদিনাতুল উলুম মাদরাসা</b></h3>
                        <h5 class="text-dark text-center " style="padding-bottom:11px">কাকচিড়া, পাথরঘাটা, বরগুনা ।</h5>
                        <div class="col-md-5 m-auto">
                        <form action="" method="post">
                              <div class="card p-4">
                                    <div class="card-header text-center py-3"><b><h5 >লগিন ফর্ম</h5></b></div>
                                    <div class="card-body ">
                                          <p class="text-center text-danger"><b><?php echo $message; ?></b></p>
                                                <div class="form-group my-3">
                                                      <input type="text" name="mobile" required class="form-control" placeholder="Mobile" >
                                                </div>
                                                <div class="form-group my-3">
                                                      <input type="password" name="password" required class="form-control" placeholder="Password" >
                                                </div>
                                                <div class="form-group  mb-3 text-center">
                                                      <button type="submit" class="btn btn-primary" name="login">লগিন করুন</button>
                                                </div>
                                    </div>
                              </div>
                        </form>
                        </div>
                  </div>
            </div>
      
      </section>

      <style>
            @media(max-width: 761px){
                  img{
                        width: 100%;
                  }
            }
            body{
                  background-color: #deedee; 
            }
      </style>

</body>
</html>