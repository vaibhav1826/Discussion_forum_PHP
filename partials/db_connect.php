<?php
$server="localhost";
$username="root";
$password="";
$database="users1826";

$conn= mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("database is not connected".mysqli_connect_error());
}
?>