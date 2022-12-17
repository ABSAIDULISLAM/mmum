<?php
namespace App\Classes;
use App\Classes\DB;

class Donor{
      public static function addDonor($data){
            $sql = "INSERT INTO donors (donor_type) VALUES('$data[donor_type]')";
            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  echo "<p style='color:green;'><script>alert('দাতা সফলভাবে তৈরী হয়েছে')</script></p>";
            }
      }
         // getdonorInfoById
         public static function getdonorInfoById($id){
            $query = mysqli_query(DB::con(), "SELECT * FROM donors WHERE id = '$id'");
            return $query;
      }

     // updatedonorInfo
     public static function updatedonorInfo($data, $id){
      $query = mysqli_query(DB::con(), "UPDATE donors SET donor_type = '$data[donor_type]' WHERE id = '$id'");
            if($query ==true){
                  header('Location: manage-donor.php');
                  echo "<p style='color:green;'><script>alert('donor Type Update Successfully')</script></p>";
            }
      }


           // deletedonoryById
           public static function deleteDonorById($id){
            $query = mysqli_query(DB::con(), "DELETE FROM donors WHERE id = '$id'");
      }


      // addDonorInfo
      public static function addDonorInfo($data){
            // echo "<pre>";
            // print_r($data);
            // exit();
            $sName = $data['donor_name'];
            $cName = $data['donor_type'];
            $cMobile = $data['donor_mobile'];
            $date = $data['donation_date'];
            $dAmount = $data['donation_amount'];
            $cAddress = $data['donor_address'];
            $status = $data['status'];

            $sql = "INSERT INTO donorinfo(donor_name, donor_type, donor_mobile, donation_date, donation_amount, donor_address, status, donor_image ) VALUES('$sName', '$cName', '$cMobile', '$date', '$dAmount', '$cAddress', '$status', 'donor.jpg')";

            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  echo "<p style='color:green;'><script>alert('দাতা সফলভাবে তৈরী হয়েছে')</script></p>";
            }
      }

      public static function getdonorInfo($id){
            $query = mysqli_query(DB::con(), "SELECT * FROM donorInfo WHERE id = '$id'");
            $dresult = mysqli_fetch_assoc($query); 
            return $dresult;

      }

      // updateDonor Info
      public static function updateDonorInof($data, $id){
            // echo "<pre>";
            // print_r($data);
            // exit();
            $sname = $data['donor_name'];
            $cname = $data['donor_type'];
            $cMobile = $data['donor_mobile'];
            $cSession = $data['donation_date'];
            $sAddress = $data['donation_amount'];
            $status = $data['status'];
            $address = $data['donor_address'];

            $sql = "UPDATE donorinfo SET donor_name='$sname', donor_type='$cname',  donor_mobile='$cMobile', donation_date='$cSession', donation_amount='$sAddress',  status='$status', donor_address='$address' WHERE id = '$id' ";

            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  header("Location:manage-donor.php");
                  echo "<p style='color:green;'><script>alert('Student Update Successfully')</script></p>";
            }
      }



      public static function getDonorInfoForMessage($id){
            $sql = "SELECT * FROM donorInfo WHERE id = $id";
           $query = mysqli_query(DB::con(), $sql);
           $doresult = mysqli_fetch_assoc($query);
           return $doresult;
            //   echo "<pre>";
            // print_r($doresult);
            // exit();
      }
    






}
