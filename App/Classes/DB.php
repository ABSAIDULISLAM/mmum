<?php
namespace App\Classes;

class DB{
      public static function con(){
            $hostName = "localhost";
            $userName = "root";
            $password = "";
            $dbName = "MMUM";
            $link =  mysqli_connect($hostName, $userName, $password, $dbName);
            return $link;
      }
}

?>