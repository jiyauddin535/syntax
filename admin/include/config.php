<?php 


$username = "syntax_note";
$password = "syntax#mysql@123";
$hostname = "localhost";
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";
 
//select a database to work with
$selected = mysql_select_db("syntax_note",$dbhandle)
  or die("Could not select examples");
  
  
  
/*

$con = @mysqli_connect('localhost', 'root', '', 'rahul_vehical');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}*/
//echo 'Connected to MySQL';
  ?>