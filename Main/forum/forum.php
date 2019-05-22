<?php
require_once '../php/db.php';
require_once '../php/functions.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

if($_GET['c']=="1"){
	$datas = get_publish_article();
}else{
	$c='Injection';
	switch ($_GET['c']) {
		case '2':
			$c="Injection";
			break;
		case '3':
			$c="Cross-site Scripting";
			break;
		case '4':
			$c="Broken Authentication";
			break;
		case '5':
			$c="Other";
			break;

		default:
			$c="Injection";
			break;
	}
	$datas= get_publish_article_category($c);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>White Hat Developer</title>
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
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-6">
							<label for="categories" hidden>categories</label>
							 <select id="categories">
								 <option value="1" <?php echo ($_GET['c'] == '1')?'selected':'';?>>All category</option>
								 <option value="2" <?php echo ($_GET['c'] == '2')?'selected':'';?>>Injection</option>
								 <option value="3" <?php echo ($_GET['c'] == '3')?'selected':'';?>>Cross-Site Scripting</option>
								 <option value="4" <?php echo ($_GET['c'] == '4')?'selected':'';?>>Broken Authentication</option>
								 <option value="5" <?php echo ($_GET['c'] == '5')?'selected':'';?>>Other</option>
							 </select>
					 	</div>

<script>
$( "select" ).change(function () {
 var link="forum.php?c="+$( "select option:selected" ).val();
  //alert(link);
	window.location.href = link;
});
</script>

					 	<div class="col-xs-6">
	            <a href='article_add.php' class="btn btn-default right">Add Article</a>
						</div>
          </div>

				</div>


				<div class="row">
					<div class="col-xs-12">
						<?php if(!empty($datas)):?>
							<?php foreach($datas as $row):?>
							<?php
								//remove the html tags
								$abstract = strip_tags($row['content']);
								//get 100 words as the abstract
								$abstract = mb_substr($abstract, 0, 100, "UTF-8");
								$author= get_author($row['create_user_id']);
							?>
							<!--Article List-->
							<div class="panel panel-primary">
										<div class="panel-heading">
												<h3 class="panel-title">
													<a href="article.php?p=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
													<a class="right"> <?php echo $author['name'];?><a>
												</h3>
										</div>
										<div class="panel-body">
											<p>
												<span class="label label-info"><?php echo $row['category']; ?></span>&nbsp;
												<span class="label label-danger"><?php echo $row['create_date']; ?></span>
											</p>
												<p><?php echo $abstract.'...'; ?></p>
										</div>
								</div>
								<?php endforeach; ?>
						<?php else: ?>
							<h3 class="text-center">No post</h3>
							<?php endif; ?>
					</div>
				</div>
			</div>

		</div>
		<!-- Footer -->
    <?php include_once 'footer.php'; ?>

		<script>
		$('select').formSelect();
		</script>
  </body>


</html>
