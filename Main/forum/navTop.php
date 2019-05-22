<?php
//get the name of current file , use $_SERVER['PHP_SELF'] to get the path
$current_file = $_SERVER['PHP_SELF'];
//delete the suffix by using basename
$current_file = basename($current_file , ".php");

switch ($current_file) {
	case 'index':
		$index = 1;
		break;
	case 'forum':
	case 'article';
	case 'article_add';
		$index = 2;
		break;
	case 'about':
		$index = 3;
		break;
	case 'my_post':
		$index = 4;
		break;
	default:
		$index = 0;
		break;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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

<nav class="navbar " style="background-color: #26a69ab8;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">White Hat Developer</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php echo ($index == 1)?'class="active"':'';?>><a href="../index.php">Home</a></li>
          <li <?php echo ($index == 2)?'class="active"':'';?>><a href="forum.php?c=1">Forums</a></li>
          <li <?php echo ($index == 3)?'class="active"':'';?>><a href="../about.php">About Me</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>
              <img alt="photo" src="<?php echo ($_SESSION['user_img_path'] != NULL)?'../'.$_SESSION['user_img_path']:'../images/girl.jpeg';?>" class="<?php echo $_SESSION['user_img_css']."-small";?> dropdown-trigger"/>
            </a>
            <!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content'>
              <li><a href="../index.php">Profile</a></li>
              <li><a href="article_list.php">My Posts</a></li>
              <li class="divider" tabindex="-1"></li>
              <li><a href="../php/Logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
		<style>
		</style>
  </nav>
	<script>
$('.dropdown-trigger').dropdown();
	</script>
