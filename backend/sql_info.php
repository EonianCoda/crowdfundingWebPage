<?php
    $mysql_servername = "localhost";
    $mysql_username = "root";
    $mysql_password = "rootroot";
    $mysql_DB_name = "data";

    function get_conn()
    {
      global $mysql_servername, $mysql_username, $mysql_password, $mysql_DB_name;
      $conn = mysqli_connect($mysql_servername,$mysql_username,$mysql_password,$mysql_DB_name);
      return $conn;
    }
?>