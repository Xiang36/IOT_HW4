<?php
  header("Content-Type:text/html; charset=utf-8");
  //user information
  $host = "140.120.54.157";
  $user = "Test2";
  $pass = "Test2";

  //database information
  $databaseName = "iot";
  $tableName = "light";

  $ad = "";
  if (!empty($_GET['add'])){
    $ad = $_GET['add'];
  }

  //Connect to mysql database
  $con = mysql_connect($host,$user,$pass);
  mysql_query("SET NAMES 'UTF8'");
  $dbs = mysql_select_db($databaseName, $con);


  if (!empty($ad)){
    $result = mysql_query("SELECT * FROM $tableName WHERE location = \"$ad\" ORDER BY `time` ASC");
  }else{
    $result = mysql_query("SELECT * FROM $tableName ORDER BY `location` ASC");
  }
  //Query database for data

  //store matrix
  $i=0;
  while ($row = mysql_fetch_array($result)){
    $employee[$i]=$row;
    $i++;
  }

  //echo result as json
    echo json_encode($employee);
?>
