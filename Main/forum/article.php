<?php
require_once '../php/db.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: login.php");
}
require_once '../php/functions.php';

$article = get_article($_GET['p']);
$author = get_author($article['create_user_id']);
$datas=get_comment($_GET['p']);
$_SESSION['article_id']=$article['id'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WHD: Article</title>
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
    <?php include_once 'navTop.php'; ?>
    <!-- Content -->
    <div class="content">
			<div class="container">
				<!-- First Row article-->
				<div class="row">
					<div class="col-xs-12">
						<?php if($article):?>
							<h3 class="text-center"><?php echo $article['title']; ?></h3>
							<hr>
              <div class="chip">
                <img alt="auther photo"src="<?php echo '../'.$author['img_path'];?>"/>
                <?php echo $author['name'];?>
              </div>
              <div class="chip">
                <?php echo $article['category']; ?>
              </div>
              <div class="chip right">
                <?php echo $article['create_date']; ?>
              </div>
              <hr>
							<?php echo $article['content']; ?>
              <div class="chip right">
                <a href="comment_add.php">Add Comment</a>
              </div>
						<?php else: ?>
							<h3 class="text-center">No post</h3>
					    <?php endif; ?>
					</div>
          <hr>
				</div>

        <!--Second Row Comments-->
				<div class="row">
				  <div class=" col-xs-12">
				    <ul class="collection">
				      <?php if(!empty($datas)):?>
				        <?php foreach($datas as $row):?>
				        <?php
				          $comment_author = get_author($row['create_user_id']);
				          $comment= strip_tags($row['content']);
				        ?>
					    <li class="collection-item avatar">
					      <div class="chip">
					        <img src="<?php echo '../'.$comment_author['img_path'];?>"/>
					        <?php echo $comment_author['name']; ?>
					      </div>
					      <div class="chip right">
					        <?php echo $row['create_date']; ?>
					      </div>
					      <p><?php echo $comment; ?></p>
					    </li>
					  	<?php endforeach; ?>
					  <?php else: ?>
					  <h3 class="text-center">No comment</h3>
					  <?php endif; ?>
				  </ul>
			  </div>
			</div>
		</div>
	</div>
		<!-- Footer-->
    <?php include_once 'footer.php'; ?>
		<script>
			$('select').formSelect();
		</script>
  </body>


</html>
