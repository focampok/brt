<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "1234";
$dbname = "bd_guategas";

//$localhost = "mysql.hostinger.es";
//$username = "u469962053_gg";
//$password = "12345678";
//$dbname = "u469962053_gg";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>