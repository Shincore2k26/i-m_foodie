<?php

$server_name="localhost";
$user_name="root";
$user_pwd="";
$db_name="foodie";

$connect=mysqli_connect($server_name,$user_name,$user_pwd,$db_name);
if(!$connect){
    die("Database Failed");
}
?>