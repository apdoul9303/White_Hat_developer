<?php
//load db.php ,connect to the database
require_once 'php/db.php';
include_once 'php/index_function.php';

//session control for verifying user persistently
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: login.php");
}

if($_SESSION['is_admin']){
	header("Location: admin/index.php");
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
    <script src='js/jquery-3.3.1.min.js'></script>

    <!-- Compiled and minified CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
  </head>


  <body>
    <!-- Header -->
    <?php include_once 'navTop.php'; ?>

    <!-- Content -->
    <style type="text/css">
      .bgimg
      {
          background-image: url('images/bg.jpg');
      }
    </style>


    <div class="jumbotron">
      <div class="container">
        <div class="row" >
          <div class="col s12">
            <div class="text-center">
                <div class="col m3 s12">
                  <a href="photo_add.php"><img alt="photo" src="<?php echo ($_SESSION['user_img_path'] != NULL)?$_SESSION['user_img_path']:'images/giraffe.jpg';?>"  class="<?php echo $_SESSION['user_img_css'];?>"/></a>
                  <h6><?php echo $_SESSION['user_name']?></h6>
                </div>
                <div  class="col m3 s12">
                  <h4>Lessons Completed</h4>
                  <h4><?php echo $lessionCount?>%</h4>
               </div>
               <div  class="col m3 s12">
                 <h4>Learning Time</h4>

                 <h4><?php echo $LR;?> Mins</h4>
              </div>
              <div  class="col m3 s12">
                <h4>Badges</h4>
                <br>
                <h4><?php echo $bages;?></h4>
             </div>
           </div><!--text center-->
          </div>
        </div>
      </div>
    </div>

  <div class="content">
    <div class="container">
      <!-- creat the fiirst row -->
      <div class="row">
        <!--  http://getbootstrap.com/css/#grid -->
        <div class="col-xs-12">
          <h1>Dash Board</h1>
          <div class="progress">
    <div class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar" aria-valuenow="<?php echo $lessionCount?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lessionCount?>%;">
      <span class="sr-only"><?php echo $lessionCount?>% Complete</span>
    </div>
  </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" id="overView"class="active"><a id="overView">OverView</a></li>
            <li role="presentation" id="syllabus" ><a id="syllabus" href="JavaScript:void(0);">Syllabus</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 " id="overViewContent">
          <h1>Welcome!</h1>
          <p>The aim of this project is to improve the web development methods based on PHP.
						This research will focus on addressing the most basic web vulnerabilities caused
						by bad logic and syntax.<br><br>

						In this website, there are some actual examples of vulnerabilities and improvements
						will be presented, and you can try to attack them and compare these vulnerable design
						with the improved one. Learning the secure web development methods by following ten lessons!
					</p>
        </div>
      </div>
<!--Syllabus-->
      <div class="row" >
        <div class="col-xs-12">
          <ul class="collapsible" id="list" hidden="ture">
            <li>
              <div class="collapsible-header"><i class="material-icons"><?php echo ($_SESSION['user_L1'] == 1)?'check_box':'check_box_outline_blank';?></i>Introduction</div>

              <div class="collapsible-body">
                <span>
                  <a href="lessons/learn01.php" class="list-group-item <?php echo ($_SESSION['user_L1'] == 1)?'list-group-item-success':'';?>">Lesson 1: Introduction<span class="new badge"data-badge-caption=" mins">5</span></a>
                </span>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons"><?php echo ($_SESSION['user_L2']&& $_SESSION['user_L3']&&$_SESSION['user_L4']== 1)?'check_box':'check_box_outline_blank';?></i>SQL Injection</div>
              <div class="collapsible-body">
                <span>
                  <a href="lessons/learn02.php" class="list-group-item <?php echo ($_SESSION['user_L2'] == 1)?'list-group-item-success':'';?>">Lesson 2: Introduction of SQL Injection<span class="new badge"data-badge-caption=" mins">5</span></a>
                  <a href="lessons/learn03.php" class="list-group-item <?php echo ($_SESSION['user_L3'] == 1)?'list-group-item-success':'';?>">Lesson 3: In-Band Injection(Login System)<span class="new badge"data-badge-caption=" mins">20</span></a>
                  <a href="lessons/learn04.php?id=1" class="list-group-item <?php echo ($_SESSION['user_L4'] == 1)?'list-group-item-success':'';?>">Lesson 4: Union-Based Injection<span class="new badge"data-badge-caption=" mins">20</span></a>
                </span>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons"><?php echo ($_SESSION['user_L5']&& $_SESSION['user_L6']&&$_SESSION['user_L7']&&$_SESSION['user_L8']== 1)?'check_box':'check_box_outline_blank';?></i>Cross-site script</div>
              <div class="collapsible-body">
                <span>
                  <a href="lessons/learn05.php" class="list-group-item <?php echo ($_SESSION['user_L5'] == 1)?'list-group-item-success':'';?>">Lesson 5: Introduction of Cross-site script<span class="new badge"data-badge-caption=" mins">5</span></a>
                  <a href="lessons/learn06.php" class="list-group-item <?php echo ($_SESSION['user_L6'] == 1)?'list-group-item-success':'';?>">Lesson 6: Reflected XSS<span class="new badge"data-badge-caption=" mins">20</span></a>
                  <a href="lessons/learn07.php" class="list-group-item <?php echo ($_SESSION['user_L7'] == 1)?'list-group-item-success':'';?>">Lesson 7: DOM-Based XSS<span class="new badge"data-badge-caption=" mins">20</span></a>
                  <a href="lessons/learn08.php" class="list-group-item <?php echo ($_SESSION['user_L8'] == 1)?'list-group-item-success':'';?>">Lesson 8: Malicious phishing website<span class="new badge"data-badge-caption=" mins">5</span></a>
                </span>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons"><?php echo ($_SESSION['user_L9']&& $_SESSION['user_L10']== 1)?'check_box':'check_box_outline_blank';?></i>Broken Authentication and Session Control</div>
              <div class="collapsible-body">
                <span>
                  <a href="lessons/learn09.php" class="list-group-item <?php echo ($_SESSION['user_L9'] == 1)?'list-group-item-success':'';?>">Lesson 9: Introduction of Broken Authentication<span class="new badge"data-badge-caption=" mins">5</span></a>
                  <a href="lessons/learn10.php" class="list-group-item <?php echo ($_SESSION['user_L10'] == 1)?'list-group-item-success':'';?>">Lesson 10: Session Control(Login System)<span class="new badge"data-badge-caption=" mins">20</span></a>
                </span>
              </div>
            </li>
          </ul>
        </div>
      </div>
  </div>

    <!-- Footer -->

    <?php include_once 'footer.php'; ?>
		<script>
		$(document).ready(function(){
		    $("a#syllabus").on("click", function(){
		      $("ul.nav.nav-tabs.nav-justified li[class='active']").removeClass("active");
		      $(this).parent('li').addClass("active")
		      $("div#overViewContent").hide();
		      $("ul#list").slideDown();
		    });

		    $("a#overView").on("click", function(){
		      $("ul.nav.nav-tabs.nav-justified li[class='active']").removeClass("active");
		      $(this).parent('li').addClass("active")
		      $("ul#list").hide();
		      $("div#overViewContent").show();
		    });

		/** Drowp Down*/
		      $('.dropdown-trigger').dropdown();

		  });

		  $(document).ready(function(){
		    $('.collapsible').collapsible();
		  });

		  </script>


  </body>


</html>
