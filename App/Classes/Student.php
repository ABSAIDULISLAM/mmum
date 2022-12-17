<?php 
namespace App\Classes;
use App\Classes\DB;

class Student{
      public static function addStudentInfo($data){

           $stName = $data['student_name'];
           $clName = $data['class_name'];
           $skName = $data['shakha_name'];
           $sName = $data['sesion_name'];
           $roll = $data['roll'];
           $mobile = $data['mobile'];
           $sql = "INSERT INTO student(student_name, class_id, shakha_id, session_id, roll, mobile, status, student_image) VALUES('$stName', '$clName', '$skName', '$sName', '$roll', '$mobile', '1', 'student.jpg')";

           $query = mysqli_query(DB::con(), $sql);
           if($query){
            echo "<p style='color:green;'><script>alert('Student Added Successfully')</script></p>";
           }
      }


      public static function getStudentInfoByIdForShow($id){
            $sql = "SELECT * FROM student WHERE id='$id'";
            $query = mysqli_query(DB::con(), $sql);
            $stInfo = mysqli_fetch_assoc($query);
            return $stInfo;
      }


      // updateStudentInfo
      public static function updateStudentInfo($data, $id){
            // echo "<pre>";
            // print_r($data);
            // exit();
            $stName = $data['student_name'];
            $clName = $data['class_name'];
            $skName = $data['shakha_name'];
            $snName = $data['sesion_name'];
            $roll = $data['roll'];
            $mobile = $data['mobile'];
            $status = $data['status'];

            $sql = "UPDATE student SET student_name='$stName',  class_id='$clName', shakha_id='$skName', session_id='$snName', roll='$roll', mobile='$mobile', status='$status' WHERE id = '$id'";

            $query = mysqli_query(DB::con(), $sql);
            if($query){
                  header("Location: manage-student.php?message=<script>alert('মেসেজ সফলভাবে প্রেরিত হয়েছে')</script>");
                  // echo "<p style='color:green;'><script>alert('Student Update Successfully')</script></p>";
            }
      }





}
