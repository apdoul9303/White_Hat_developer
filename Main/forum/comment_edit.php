<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

$data = get_one_comment($_GET['i']);
$article=get_article($data['comment_article_id']);
if(is_null($data))
{
	header("Location: article_list.php");
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Edit Comment</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- For mobile devices or flat panel display, depending on the width
    of the device, the initial magnification ratio 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script src='../js/jquery-3.3.1.min.js'></script>

    <!-- Compiled and minified CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <link rel="shortcut icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <!-- Header-->
		<?php include_once 'menu.php'; ?>

    <!-- Content -->
    <div class="content">
      <div class="container">
        <!-- First Row  -->
        <div class="row">
          <div class="col-xs-12">
            <form id="edit_article_form">
            	<input type="hidden" id="id" value="<?php echo $data['id'];?>">
              <div class="form-group">
                <label for="title"> Article Title</label>
                <input type="input" class="form-control" id="title" value="<?php echo $article['title'];?>" readonly>
              </div>

              <div class="form-group">
                <label for="content">Content</label>
                <textarea type="input" class="form-control" id="content"><?php echo $data['content'];?></textarea>
              </div>

              <button type="submit" class="btn btn-default">Submit</button>
              <div class="loading text-center"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    	$(document).on("ready", function(){

    		$("#edit_article_form").on("submit", function(){
    			//add loading icon
    			$("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

    			if($("#content").val() == ''){
    				alert("Please fill in the content");//請填入內文

    				//clean loading icon
    				$("div.loading").html('');
    			}else{

						$.ajax({
	            type : "POST",
	            url : "../php/update_comment.php",
	            data : {
	            	id : $("#id").val(),
	              content : $("#content").val(),
	            },
	            dataType : 'html'
	          }).done(function(data) {
	            //Successful
	            if(data == "yes")
	            {
	              alert("Update successful，Click to confirm back to the list");
	              window.location.href = "article_list.php";
	            }
	            else
	            {
	              alert("Update failed");
	            }

	          }).fail(function(jqXHR, textStatus, errorThrown) {
	            alert("Error occur，please check the console log");
	            console.log(jqXHR.responseText);
	          });
    			}
    			return false;
    		});
    	});
    </script>
  </body>
</html>
