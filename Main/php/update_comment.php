<?php
//require the database and php funcitons
require_once 'db.php';
require_once 'functions.php';

//session control for checkinf the login status
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//Execute the method of updating a comment,
	//and directly throw the entire $_POST individual sequence variable to the method.
	$update_result = update_comment($_POST['id'], $_POST['content']);

	if($update_result)
	{
		//If true means the update is successful, print yes
		echo 'yes';
	}
	else
	{
		//If null or false means failure
		echo 'no';
	}
}
else
{
	//If null or false means failure
	echo 'no';
}
?>
