<?php

$dbname = 'syntax_note';
$dbuser = 'syntax_note';
$dbpass = 'syntax@123';
$dbhost = 'localhost';

$con = mysqli_connect("localhost","syntax_note","syntax@123","syntax_note");
//print_r($con) ;

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{
  	echo "ddd" ;
  }

  $sql_stmt = "SELECT * FROM user_data"; 
    //SQL select query 
    
     $result = mysqli_query($con,$sql_stmt);
     $row = mysqli_fetch_array($result) ;
     print_r($row) ;
     //execute SQL statement

  /*

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");*/


 ?>