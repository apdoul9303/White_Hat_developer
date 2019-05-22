<?php
//require the database and php funcitons
require_once 'db.php';


//session control for checkinf the login status
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){

	if(file_exists("../" . $_POST['file']))
	{
		//Delete if the file exists

		unlink("../" . $_POST['file']);

		echo 'yes';
	}
	else
	{
		echo 'No file';
	}
}
else
{
	echo 'Please Login';
}

?>
