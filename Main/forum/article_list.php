<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: login.php");
}

$articles = get_my_article($_SESSION['login_user_id']);
$comments = get_my_comment($_SESSION['login_user_id']);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: My Post</title>
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
            <a href='article_add.php' class="btn btn-default">Add New Article</a>
          </div>
          <div class="col-xs-12">
						<h3>My Article</h3>
            <table class="table table-hover">
              <tr>
                <th>Category</th>
                <th>Title</th>
                <th>Publish Status</th>
                <th>Create Time </th>
                <th>Management</th>
              </tr>
              <?php if($articles):?>
                <?php foreach($articles as $article):?>
                  <tr>
                    <td><?php echo $article['category'];?></td>
                    <td><?php echo $article['title'];?></td>
                    <td><?php echo ($article['publish'])?"Published":"Unpublished";?></td>
                    <td><?php echo $article['create_date'];?></td>
                    <td>
                      <a href='article_edit.php?i=<?php echo $article['id'];?>' class="btn btn-default">Edit</a>
                      <a href='javascript:void(0);' class='btn btn-default del_article' data-id="<?php echo $article['id'];?>">Delete</a>
                    </td>
                  </tr>
                <?php endforeach;?>
              <?php else:?>
                <tr>
                  <td colspan="5">No post</td>
                </tr>
              <?php endif;?>
            </table>
          </div>
        </div>
				<!--Second Row-->
				<div class="row">
					<div class="col-xs-12">
						<h3>My Comment</h3>
            <table class="table table-hover">
              <tr>
                <th>ArticleID</th>
								<th>Content</th>
                <th>Create Time</th>
                <th>Management</th>
              </tr>
              <?php if($comments):?>
                <?php foreach($comments as $comment):
									//format the abstract and remove the html tags
									$abstract = strip_tags($comment['content']);
									//get the first 20 words as abstract
									$abstract = mb_substr($abstract, 0, 20, "UTF-8")
									?>

                  <tr>
                    <td><?php echo $comment['comment_article_id'];?></td>
                    <td><?php echo $abstract;?></td>
                    <td><?php echo $comment['create_date'];?></td>
                    <td>
                      <a href='comment_edit.php?i=<?php echo $comment['id'];?>' class="btn btn-default">Edit</a>
                      <a href='javascript:void(0);' class='btn btn-default del_comment' data-id="<?php echo $comment['id'];?>">Delete</a>
                    </td>
                  </tr>
                <?php endforeach;?>
              <?php else:?>
                <tr>
                  <td colspan="5">No post</td>
                </tr>
              <?php endif;?>
            </table>
          </div>
				</div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    	$(document).on("ready", function(){

    		//Sent the form of article
    		$("a.del_article").on("click", function(){
    			var c = confirm("Are you sure you want to delete it？"),
    					this_tr = $(this).parent().parent();
    			if(c){
    				$.ajax({
            type : "POST",
            url : "../php/del_article.php",
            data : {
              id : $(this).attr("data-id")
            },
            dataType : 'html'
          }).done(function(data) {
            //Successful
            if(data == "yes")
            {
              alert("Delete successfully, click to confirm to remove from the list.");
              this_tr.fadeOut();
            }
            else
            {
              alert("Delete Error:"+data);
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
		<script>
    	$(document).on("ready", function(){

    		//sent the form of comment
    		$("a.del_comment").on("click", function(){
    			var c = confirm("Are you sure you want to delete it？"),
    					this_tr = $(this).parent().parent();
    			if(c){
    				$.ajax({
            type : "POST",
            url : "../php/del_comment.php",
            data : {
              id : $(this).attr("data-id")
            },
            dataType : 'html'
          }).done(function(data) {
            //Successful
            if(data == "yes")
            {
              alert("Delete successfully, click to confirm to remove from the list.");
              this_tr.fadeOut();
            }
            else
            {
              alert("Delete Error:"+data);
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
