<?php
//取得目前檔案的名稱。透過$_SERVER['PHP_SELF']先取得路徑
$current_file = $_SERVER['PHP_SELF'];
//echo $current_file; //查看目前取得的檔案完整
//然後透過 basename 取得檔案名稱，加上第二個參數".php"，主要是將取得的檔案去掉 .php 這副檔名稱
$current_file = basename($current_file , ".php");
//echo $current_file; //查看目前取得後的檔名

switch ($current_file) {
	case 'about':
		$index = 1;
		break;
	case 'login':
		$index = 2;
		break;
	case 'register':
		$index = 3;
		break;
	default:
		$index = 0;
		break;
}
?>

<nav class="navbar " style="background-color: #26a69ab8;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">White Hat Developer</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li <?php echo ($index == 1)?'class="active"':'';?>><a href="aboutLR.php">About Me</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo ($index == 3)?'login.php':'register.php';?>"><?php echo ($index == 3)?'Login':'Register';?></a></li>
				</ul>
			</div>
		</div>
	</nav>
