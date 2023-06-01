<?php
$host="localhost";
$username="root";
$pass="";
$db="prysch";

$conn=mysqli_connect($host, $username, $pass, $db);
if(!$conn){
    die("connection failed".mysqli_connect_error());
}


?>