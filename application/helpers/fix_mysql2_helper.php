<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$sql_host =     "localhost";      
$sql_username = "root";    
$sql_password = "";       
$sql_database = "db_keupb";       


$mysqli = new mysqli($sql_host , $sql_username , $sql_password , $sql_database );
if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

function mysql_query($query){
  $result = $mysqli->query($query);
  return $result;

}

function mysql_fetch_array($result){
  if($result){
    $row =  $result->fetch_assoc();
    return $row;
  }
}

function mysql_num_rows($result){
  if($result){
   $row_cnt = $result->num_rows;;
   return $row_cnt;
 }
}

}