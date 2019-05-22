<?php
//require the database and php funcitons
require_once 'db.php';
require_once 'functions.php';

//session control for verify the user persistently
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//Execute the method of adding an article,
	//and directly throw the entire $_POST individual sequence variable to the method.
	$add_result = add_article($_POST['title'], $_POST['category'], $_POST['content'], $_POST['publish']);

	if($add_result)
	{
		//If true means the new addition is successful, print yes
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
