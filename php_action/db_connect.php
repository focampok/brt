<?php 	

//$localhost = "mysql.hostinger.es";
//$username = "u469962053_ggas";
//$password = "12345678";
//$dbname = "u469962053_ggas";

$localhost = "localhost";
$username = "root";
$password = "1234";
$dbname = "bd_guategas";

//$localhost = "localhost";
//$username = "id4751577_guategas";
//$password = "12345678";
//$dbname = "id4751577_guategas";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>