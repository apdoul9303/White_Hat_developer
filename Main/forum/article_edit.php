<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

//get the data of this article by article id
$data = get_article($_GET['i']);
if(is_null($data))
{
	header("Location: article_list.php");
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Article Edit</title>
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

    <!-- Content-->
    <div class="content">
      <div class="container">
        <!-- First Row -->
        <div class="row">
					<div class="col-xs-12">
            <form id="edit_article_form">
            	<input type="hidden" id="id" value="<?php echo $data['id'];?>">
              <div class="form-group">
                <label for="title">Title </label>
                <input type="input" class="form-control" id="title" value="<?php echo $data['title'];?>">
              </div>
               <div class="form-group">
                <label for="category">Category</label>
                <select id="category" class="form-control">
                  <option value="Injection" <?php echo ($data['category'] == "Injection")?"checked":"";?>>Injection</option>
                  <option value="Cross-site Scripting" <?php echo ($data['category'] == "Cross-site Scripting")?"checked":"";?>>Cross-site Scripting</option>
							  	<option value="Broken Authentication" <?php echo ($data['category'] == "Broken Authentication")?"checked":"";?>>Broken Authentication</option>
								  <option value="Other" <?php echo ($data['category'] == "Other")?"checked":"";?>>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea type="input" class="form-control" id="content"><?php echo $data['content'];?></textarea>
              </div>
              <div class="form-group">
								<label>
					        <input class="with-gap" type="radio"  name="publish" value="1" checked/>
					        <span>Publish</span>
				      	</label>
								<label>
									<input class="with-gap" type="radio"  name="publish" value="0"/>
									<span>No Publish</span>
								</label>
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
    		//sent the form
    		$("#edit_article_form").on("submit", function(){
    			//add loading icon
    			$("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

    			if($("#title").val() == '' || $("#content").val() == ''){
    				alert("Please fill in the title , content or check the status");

    				//delete loading icon
    				$("div.loading").html('');
    			}else{
						$.ajax({
	            type : "POST",
	            url : "../php/update_article.php",
	            data : {
	            	id : $("#id").val(),
	              title : $("#title").val(),
	              category : $("#category").val(),
	              content : $("#content").val(),
	              publish : $("input[name='publish']:checked").val() /
	            },
	            dataType : 'html'
	          }).done(function(data) {

	            if(data == "yes")
	            {
	              alert("The update is successful, click to confirm the list back");
	              window.location.href = "article_list.php";
	            }
	            else
	            {
	              alert("Update Error");
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
