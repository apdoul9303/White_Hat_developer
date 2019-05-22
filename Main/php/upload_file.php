<?php
//print_r($_FILES);
//echo "<hr>";
//print_r($_POST);

	//上傳檔案的資訊，則需要透過 $_FILES 取得，為二維陣列
	//print_r($_FILES);
	//echo $_FILES['file']['name']; 第一個陣列索引值，是表單給予的 name="image_path" 而來的，第二個索引值 name 代表是上傳的檔案名稱
	//echo $_FILES['file']['type'];		//檔案型態
	//echo $_FILES['file']['tmp_name'];	//上傳後暫存在 server 的中的位置及檔名
	//echo $_FILES['file']['error'];		//錯誤碼0,為上傳正常 4為沒選擇檔案
	//echo $_FILES['file']['size'];		//檔案大小，以 byte 為單位



	//Formating the upload file
	//file_exists function to discriminate there is the file on the server or not
	if(file_exists($_FILES['file']['tmp_name']))//file 指append命名
	{
		//define the save path for the file
		$target_folder = $_POST['save_path'];

		//get the name of the file
		$file_name = $_FILES['file']['name'];

//MOVE FILE
		if(move_uploaded_file($_FILES['file']['tmp_name'], "../" . $target_folder . $file_name))
		{
			echo "yes";
		}
		else
		{
			echo "move file failed, please check {$_POST['save_path']} is available to move in.";
		}
	}
	else
	{
		echo "the temporary archive does not exist, upload failed";
	}


?>
