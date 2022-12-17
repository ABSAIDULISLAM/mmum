<?php 
namespace App\Classes;
use App\Classes\DB;

class AddClasses{
      // addClassName
      public static function addClassName($data){

            $sql = "INSERT INTO class (class_name) VALUES('$data[class_name]')";
           $query = mysqli_query(DB::con(), $sql);
           if($query){
            echo "<p style='color:green;'><script>alert('শাখা সফলভাবে তৈরী হয়েছে')</script></p>";
           }
      }
      // addShakhaName
      public static function addShakhaName($data){
            $sql = "INSERT INTO shakha (class_id, section_name) VALUES('$data[class_name]', '$data[section_name]')";
           $query = mysqli_query(DB::con(), $sql);
            if($query){
                  echo "<p style='color:green;'><script>alert('শাখা সফলভাবে তৈরী হয়েছে')</script></p>";
                 }
      }

      // getClassInfoById
      public static function getClassInfoById($id){
            $query = mysqli_query(DB::con(), "SELECT * FROM class WHERE id = '$id'");
            return $query;
      }
      // updateClassInfo
      public static function updateClassInfo($data, $id){
            $query = mysqli_query(DB::con(), "UPDATE class SET class_name = '$data[class_name]' WHERE id = '$id'");
            if($query ==true){
                  header('Location: add-class.php');
                  echo "<p style='color:green;'><script>alert('Student Update Successfully')</script></p>";
            }
      }

      // updateShakaInfo
      public static function updateShakaInfo($data, $id){
            $cName = $data['class_name'];
            $sName = $data['section_name'];

            $query = mysqli_query(DB::con(), "UPDATE shakha SET class_id = '$cName', section_name = '$sName' WHERE id = '$id'");
            if($query ==true){
                  header('Location: add-class.php');
            }
      }
      // deleteclassInfo
      public static function deleteclassInfo($id){
            $query = mysqli_query(DB::con(), "DELETE FROM class WHERE id = '$id'");
      }
      // deleteShakhaInfo
      public static function deleteShakhaInfo($id){
            $query = mysqli_query(DB::con(), "DELETE FROM shakha WHERE id = '$id'");
      }
      
      // addsession
      public static function addSession($data){
            $query = mysqli_query(DB::con(), "INSERT INTO session (session) VALUES('$data[session]')");
            if($query ){
                  echo "<p style='color:green;'><script>alert('সেশন সফলভাবে তৈরী হয়েছে')</script></p>";

            }
      }

}


?>