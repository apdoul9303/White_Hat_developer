<?php
//require the database and php funcitons
require_once 'db.php';
//require_once 'functions.php';

//Insecure
$username = $_POST['un'];
$pass = $_POST['pw'];
$password = md5($pass);

$sql = "SELECT * FROM `user` WHERE `username` LIKE '".$username."' AND `password` LIKE '".$password."'";
$res = mysqli_query($_SESSION['link'],$sql);
$result = mysqli_fetch_array($res);
 if(empty($result)){
   echo'no';

 }else{
   echo'yes';
 }
?>
