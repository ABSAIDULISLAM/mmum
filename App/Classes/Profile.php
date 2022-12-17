<?php
namespace App\Classes;
use App\Classes\DB;

class Profile{

      // user Profile Update
      public static function getUserInfoById($id){
            $sql = "SELECT * FROM login WHERE id = '$id' ";
            $userInfo = mysqli_query(DB::con (), $sql);
            return $userInfo;
      }


      // updateUserPassword
      public static function updateUserPassword($data, $id){

            $query = mysqli_query(DB::con(), "SELECT * FROM login WHERE id = '$id'");
            $quResult = mysqli_fetch_assoc($query);
            $userPass = $quResult['password'];

           $cur_pass = $data['current_password'];
           $new_pass = $data['newpassword'];
           $renew_pass = $data['renewpassword'];

           if($userPass == $cur_pass && $new_pass == $renew_pass){
                  $sql = "UPDATE login SET password = '$new_pass' WHERE id = '$id'";
                  if(mysqli_query(DB::con(), $sql)){
                        $message = "<h4 style='color: #157347'>Password Updated Successfully</h4>";
                        return $message;
                  }else{
                        die("query Problem".mysqli_error(DB::con()));
                  }
                  
           }else{
                  $message = "<h4 style='color: red'>Password not Matched</h4>";
                  return $message;
           }
      }

      // updateUserInfo
      public static function updateUserInfo($data, $id){
            // echo "<pre>";
            // print_r($data);
            // exit();
            $postimage = $_FILES['profile_image']['name'];
    
            if($postimage){
                    //ager image unset  or delete korar jonno
                $sql = "SELECT * FROM login WHERE id = '$id'";
                $queryResult = mysqli_query(DB::con(), $sql);
                $postInfo = mysqli_fetch_assoc($queryResult);
                unlink($postInfo['user_image']);
    
    
                $fileName = $_FILES['profile_image']['name'];
                $directory = "../assets/img/";
                $imageUrl = $directory.$fileName;
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                // $imageSize = $_FILES['profile_image']['size'];
                $check = getimagesize($_FILES['profile_image']['tmp_name']);
        
                if($check){
                    if(file_exists($imageUrl)){
                        die('File Already Exists. Please try again with Another file. Thanks!');
                    }else{
                        if($_FILES['profile_image']['size'] > 5000000){
                            die('Your File Too big. Please Select file Between 5mb, Thanks!');
                        }else{
                            if($fileType != 'jpg' && $fileType != 'png' && $fileType != 'gif' && $fileType != 'docx' && $fileType != 'JPG' && $fileType != 'PNG' && $fileType != 'GIF' && $fileType != 'DOCX' ){
                                die('Please Select jpg, png, gif, docx file only. Thanks!');
                            }else{
                                move_uploaded_file($_FILES['profile_image']['tmp_name'], $imageUrl);
        
                                $sql = "UPDATE login SET user_image= '$imageUrl', name='$data[name]' WHERE id = '$id'";
        
                                if(mysqli_query(DB::con(), $sql)){
                                    $message = "Profile Updated Successfully";
                                    return $message;
                                }else{
                                    die('Query Problem').mysqli_error(DB::con());
                                }
                            }
                        }
                    }
                }else{
                    die('Please Chose a Image File. Thanks!');
                }
    
    
    
            }
            else{
                
                $sql = "UPDATE login SET name='$data[name]' WHERE id = '$id'";
    
                if(mysqli_query(DB::con(), $sql)){
                    $message =  "Profile Updated Successfullt";
                    return $message;
                }else{
                    die('Query Problem').mysqli_error(DB::con());
                }
            }
              
      }

    //   for admin
    
      // user Profile Update
      public static function getAdminInfoById($id){
        $sql = "SELECT * FROM login WHERE id = '$id' ";
        $userInfo = mysqli_query(DB::con (), $sql);
        return $userInfo;
  }


   // update admin Password
   public static function updateadminPassword($data, $id){

    $query = mysqli_query(DB::con(), "SELECT * FROM login WHERE id = '$id'");
    $quResult = mysqli_fetch_assoc($query);
    $userPass = $quResult['password'];

   $cur_pass = $data['current_password'];
   $new_pass = $data['newpassword'];
   $renew_pass = $data['renewpassword'];

   if($userPass == $cur_pass && $new_pass == $renew_pass){
          $sql = "UPDATE login SET password = '$new_pass' WHERE id = '$id'";
          if(mysqli_query(DB::con(), $sql)){
                $message = "<h4 style='color: #157347'>Password Updated Successfully</h4>";
                return $message;
          }else{
                die("query Problem".mysqli_error(DB::con()));
          }
          
   }else{
          $message = "<h4 style='color: red'>Password not Matched</h4>";
          return $message;
   }
}




    // update admin Info
    public static function updateAdminInfo($data, $id){
        // echo "<pre>";
        // print_r($data);
        // exit();
        $postimage = $_FILES['profile_image']['name'];

        if($postimage){
                //ager image unset  or delete korar jonno
            $sql = "SELECT * FROM login WHERE id = '$id'";
            $queryResult = mysqli_query(DB::con(), $sql);
            $postInfo = mysqli_fetch_assoc($queryResult);
            unlink($postInfo['user_image']);


            $fileName = $_FILES['profile_image']['name'];
            $directory = "../assets/img/";
            $imageUrl = $directory.$fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            // $imageSize = $_FILES['profile_image']['size'];
            $check = getimagesize($_FILES['profile_image']['tmp_name']);
    
            if($check){
                if(file_exists($imageUrl)){
                    die('File Already Exists. Please try again with Another file. Thanks!');
                }else{
                    if($_FILES['profile_image']['size'] > 5000000){
                        die('Your File Too big. Please Select file Between 5mb, Thanks!');
                    }else{
                        if($fileType != 'jpg' && $fileType != 'png' && $fileType != 'gif' && $fileType != 'docx' && $fileType != 'JPG' && $fileType != 'PNG' && $fileType != 'GIF' && $fileType != 'DOCX' ){
                            die('Please Select jpg, png, gif, docx file only. Thanks!');
                        }else{
                            move_uploaded_file($_FILES['profile_image']['tmp_name'], $imageUrl);
    
                            $sql = "UPDATE login SET user_image= '$imageUrl', name='$data[name]' WHERE id = '$id'";
    
                            if(mysqli_query(DB::con(), $sql)){
                                $message = "Profile Updated Successfully";
                                return $message;
                            }else{
                                die('Query Problem').mysqli_error(DB::con());
                            }
                        }
                    }
                }
            }else{
                die('Please Chose a Image File. Thanks!');
            }



        }
        else{
            
            $sql = "UPDATE login SET name='$data[name]' WHERE id = '$id'";

            if(mysqli_query(DB::con(), $sql)){
                $message =  "Profile Updated Successfullt";
                return $message;
            }else{
                die('Query Problem').mysqli_error(DB::con());
            }
        }
          
  }








}





?>