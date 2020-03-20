<?php
//Start session to save the connected information @是為了不要出現錯誤訊息
session_start();

//detting the database, the host usually is the localhot
$host = 'localhost';
//'root' is the username
$dbuser = 'root';
//'MYPASSWORD' is the password
$dbpw = 'MYPASSWORD';
//select the datacase for this web application
$dbname = 'my_db';



//detting the database, the host usually is the localhot
//$host = 'localhost';
//'root' is the username
//$dbuser = 'id6766063_tyl2y17';
//'MYPASSWORD2BTD' is the password
//$dbpw = 'MYPASSWORD2BTD';
//select the datacase for this web application
//$dbname = 'id6766063_tyldb';

//Declare a link variable and execute the database linking function mysqli_connect().
//The link result will be store into the $_SESSION['link'].
$_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);

if ($_SESSION['link'])
{
  //If the positive value is returned, it means that it has been connected.
  //Set the connection code to UTF-8
  //mysqli_query(database link, "sql query") to execute sql query
  mysqli_query($_SESSION['link'], "SET NAMES utf8");
}
else
{
  //connect fail mysqli_connect_error() shows the error message
  echo 'Unable to connect to mysql database :<br/>' . mysqli_connect_error();
}
?>
