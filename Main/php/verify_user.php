<?php
//require the database and php funcitons
require_once 'db.php';
require_once 'functions.php';

//Execute the method of verifying user,
//and directly throw the entire $_POST individual sequence variable to the method.
$result= verify_user($_POST['un'], $_POST['pw']);
if($result)
{
	//If true means the new addition is successful, print yes
	echo 'yes';
}
else
{
	//If null or false means failure
	echo 'no';
}

?>
