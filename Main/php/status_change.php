<?php
//This is the function for record the user's leaning status
//require the database and php funcitons
require_once 'db.php';
//require_once 'functions.php';


$l = $_POST['lesson'];//which Lesson
$ls = $_POST['ls'];//lesson status
$id = $_SESSION['login_user_id'];

$sql="UPDATE `realuser` SET $l = $ls WHERE `realuser`.`id` = $id";
mysqli_query($_SESSION['link'], $sql);
$sql="SELECT * FROM `realuser` WHERE `id` = '$id'";
$query = mysqli_query($_SESSION['link'], $sql);
//if query is successful
if ($query)
{
  if(mysqli_num_rows($query) == 1)
  {
    //access the data of users
    $user = mysqli_fetch_assoc($query);

    $_SESSION['user_'.$l] = $user[$l];
    echo $_SESSION['user_'.$l];
  }
}
else
{
  echo "{$sql} sql execution failed，error message：" . mysqli_error($_SESSION['link']);
}
?>
