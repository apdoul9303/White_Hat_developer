<?php
require_once '../php/db.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Add Comment</title>
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
    <!-- Header -->
	  <?php include_once 'menu.php'; ?>

    <!-- Content -->
    <div class="content">
      <div class="container">
        <!-- First Row -->
        <div class="row">
          <div class="col-xs-12">
            <form id="add_comment_form">
							<label for="article_id" hidden>article_id</label>
							  <input type="input" class="form-control" id="article_id"
								value="<?php echo$_SESSION['article_id']?>" hidden>
              <div class="form-group">
                <label for="content">Comment</label>
                <textarea type="input" class="form-control" id="content"></textarea>
              </div>

              </div>
              <button type="submit" class="btn btn-default">Submit</button>
              <div class="loading text-center"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    	$(document).on("ready", function(){

    		$("#add_comment_form").on("submit", function(){
    			//add loading icon
    			$("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

    			if($("#content").val() == ''){
    				alert("Please fill in the content");

    				//delete loading icon
    				$("div.loading").html('');
    			}else{
						$.ajax({
	            type : "POST",
	            url : "../php/add_comment.php",
	            data : {
	              content : $("#content").val(),

	            },
	            dataType : 'html'
	          }).done(function(data) {
	            //Successful
	            if(data == "yes")
	            {
	              //successfully add the comment and turn back to this article
	              alert("Add Comment succefful, click to confirm back to the list");
	              window.location.href = "article.php?p="+$('#article_id').val();
	            }
	            else
	            {
	              alert("Add Comment failed");
	            }

	          }).fail(function(jqXHR, textStatus, errorThrown) {
	            //Failed
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
