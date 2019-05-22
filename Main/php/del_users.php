<?php
//require the database and php funcitons
require_once 'db.php';
require_once 'functions.php';

//session control for checkinf the login status
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//Execute the method of delete an user ,
	//and directly throw the entire $_POST individual sequence variable to the method.
	$del_result = del_user($_POST['id']);

	if($del_result)
	{
		echo 'yes';
	}
	else
	{
		echo 'no';
	}
}
else
{
	echo 'no';
}

?>
