<?php 
namespace App\Classes;
use App\Classes\DB;
class Comite{
      public static function addcomity($data){
            $sql = "INSERT INTO comite (comite_name) VALUES('$data[comite_name]')";
            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  echo "<p style='color:green;'><script>alert('কমিটি সফলভাবে তৈরী হয়েছে')</script></p>";
            }
      }
      // getComiteInfoById
      public static function getComiteInfoById($id){
            $query = mysqli_query(DB::con(), "SELECT * FROM comite WHERE id = '$id'");
            return $query;
      }
      // updateCometeInfo
      public static function updateCometeInfo($data, $id){
            $query = mysqli_query(DB::con(), "UPDATE comite SET comite_name = '$data[comite_name]' WHERE id = '$id'");
            if($query ==true){
                  header('Location: create-commite.php');
                  echo "<p style='color:green;'><script>alert('Student Update Successfully')</script></p>";
            }
      }
      // deleteComityById
      public static function deleteComityById($id){
            $query = mysqli_query(DB::con(), "DELETE FROM comite WHERE id = '$id'");
      }

      // addSodossoInfo
      public static function addSodossoInfo($data){

            $sName = $data['sodosso_name'];
            $cName = $data['comite_name'];
            $cMobile = $data['sodosso_mobile'];
            $cSession = $data['comite_session'];
            $cAddress = $data['sodosso_address'];

            $sql = "INSERT INTO sodosso(sodosso_name, comite_id, sodosso_mobile, session_id, sodosso_address, status, sodosso_images ) VALUES('$sName', '$cName', '$cMobile', '$cSession', '$cAddress', '1', 'sodosso.jpg')";

            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  echo "<p style='color:green;'><script>alert('সদস্য সফলভাবে তৈরী হয়েছে')</script></p>";
            }
      }
      // updatesodossoInfo
      public static function updatesodossoInfo($data, $id){
            // echo "<pre>";
            // print_r($data);
            // exit();
            $sname = $data['sodosso_name'];
            $cname = $data['comite_name'];
            $cMobile = $data['sodosso_mobile'];
            $cSession = $data['comite_session'];
            $sAddress = $data['sodosso_address'];
            $status = $data['status'];

            $sql = "UPDATE sodosso SET sodosso_name='$sname', comite_id='$cname',  sodosso_mobile='$cMobile', session_id='$cSession', sodosso_address='$sAddress',  status='$status' WHERE id = '$id' ";

            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  header("Location:create-commite.php");
                  echo "<p style='color:green;'><script>alert('Student Update Successfully')</script></p>";
            }
      }



}




?>