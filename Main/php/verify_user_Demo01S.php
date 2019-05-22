<?php
require_once 'db.php';

//Secure
$username = mysqli_real_escape_string($_SESSION['link'],$_POST['un']);
$pass = mysqli_real_escape_string($_SESSION['link'],$_POST['pw']);

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
