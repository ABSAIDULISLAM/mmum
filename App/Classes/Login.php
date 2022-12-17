<?php
namespace App\Classes;
use App\Classes\DB;


class Login{
      public static function LogincCheck($data){
            $mobile = $data['mobile'];
            $password = $data['password'];

            $sql = "SELECT * FROM login WHERE mobile = '$mobile' AND password = '$password' ";
            if(mysqli_query(DB::con(), $sql)){
                 $query = mysqli_query(DB::con(), $sql);
                $result = mysqli_fetch_assoc($query);
            if($result){
                  if(($result['mobile']==$mobile) && ($result['password']==$password) && ($result['user_type']=="admin")){
                        $_SESSION['admin_id'] = $result['id'];
                        $_SESSION['admin_name'] = $result['name'];
                        header("Location: admin/dashboard.php");
                  }else if(($result['mobile']==$mobile) && ($result['password']==$password) && ($result['user_type']=="user")){
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['user_name'] = $result['name'];

                        header("Location: user/dashboard.php");
                  }

            }else{
                  $message = "Wrong Mobile or Password";
                  return $message;
            }
            }else{
                  die("Query Problem".mysqli_error(DB::con()));
            }
      }


      public static function adminlogout(){
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_name']);
            session_unset();
            session_destroy();
            header('Location: ../index.php');
      }
      public static function userlogout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            session_unset();
            session_destroy();
            header('Location: ../index.php');
      }



}



?>