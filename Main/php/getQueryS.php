<?php
//require the database and php funcitons
require_once 'db.php';
//require_once 'functions.php';

//Secure
$username = mysqli_real_escape_string($_SESSION['link'],$_POST['un']);
$pass = mysqli_real_escape_string($_SESSION['link'] ,$_POST['pw']);

$sql = "SELECT * FROM `user` WHERE `username` LIKE '".$username."' AND `password` LIKE '".$pass."'";
echo $sql;
?>
