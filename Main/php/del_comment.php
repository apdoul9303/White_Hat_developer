<?php
//require the database and php funcitons
require_once 'db.php';
require_once 'functions.php';

//session control for checkinf the login status
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//Execute the method of deleting a  comment,
	//and directly throw the entire $_POST individual sequence variable to the method.
	$del_result = del_comment($_POST['id']);

	if($del_result)
	{
		//If true means the comment is deleted successfully, print yes
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
