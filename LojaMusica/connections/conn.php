<?php

$servername = "localhost";
$username   = "root";
$password   = "";

//create connection
$conn = mysqli_connect($servername, $username, $password);

// check connection
if(!$conn){
	die("Connection failder: ".mysqli_connect_error());
}
mysqli_select_db($conn, "lojamusica");
mysqli_set_charset($conn, "utf8");

?>