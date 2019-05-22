<?php
//load and connect the database
require_once '../php/db.php';
//If there are no the value of $_SESSION['is_login']or $_SESSION['is_login'] equals false ,
//means user identity not verifed
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}
?>
<!DOCTYPE <html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>WHD:Learning</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- For mobile devices or flat panel display, depending on the width
    of the device, the initial magnification ratio 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script src='js/jquery-3.3.1.min.js'></script>
    <!-- ajax-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- Compiled and minified CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <script src='../js/learn.js'></script>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>

  <body>
    <!-- nav Top -->
    <?php include_once 'navTop.php'; ?>


    <!--nav Botton-->
      <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn08.php" data-position="top" data-tooltip="Go back to Lesson8">
            <i class="material-icons left">arrow_back</i>Back</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn10.php" data-position="top"
            data-tooltip="Before going to next lesson, don't forget to turn on the switch.">
            <i class="material-icons right">arrow_forward</i>Next</a>
        </div>
        <style>
        nav, nav .nav-wrapper i, nav a.sidenav-trigger, nav a.sidenav-trigger i {
            height: 5%;
        }
        #backButton{
          margin-left: 25%;
          vertical-align: top;

        }
        #nextButton{
          margin-left: 30%;
          vertical-align: top;
        }

        nav i, nav [class^="mdi-"], nav [class*="mdi-"], nav i.material-icons{
          line-height: 36px;
        }
        #iconLeft{
          line-height: 20px
        }
        </style>
			</nav>
<!-- nav Side -->
<?php include_once 'navSide.php'; ?>

      <!--Content-->
        <div class="col-md-4">
          <a id="list"href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">format_list_numbered</i>
          Lesson 9: Introduction of Broken Authentication</a>
            <style>
            a#list{
              vertical-align: top;
              color: green;
            }
              #textarea{
                max-height:50%;
                overflow: scroll;
              }
            </style>
          <ul class="collapsible">
    <li id="learn"class="active">
      <div class="collapsible-header"><i class="material-icons">import_contacts</i>Learn</div>
      <div class="collapsible-body" id="textarea">
        <span>
          This is the overview of Broken Authentication.
        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
          <li>Read the Introduction.</li>
          <li>If you finished, turn on the switch. This means you complete this
            lesson and it will help you to trace your learning path.</li>
          <li>Click the Next Button to the next Lesson.</li>
        </ol>
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>
          There is no code comparison in Lesson9.
        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->

        <div class="col-md-8">

          <div class="content">
            <h4>Broken Authentication and Session Management</h4>
            <hr>
            <p>
              The identity verification related features written by the web application are flawed. For example, there is no encryption when logging in, SESSION is not controlled, cookies are not protected, password strength is too weak, and so on.
            </p>
            <br><br>
            <p>
              The developer or manager must do the following checks:
<ol>
<li>Are all passwords, session IDs, and other information transmitted via encryption?</li>
<li>Are the credentials protected by encryption or hash?</li>
<li>Can the verification information be guessed or modified by other weaknesses?</li>
<li>Is the Session ID exposed in the URL?</li>
<li> Does the Session ID have a Timeout mechanism?</li>
</ol>
            </p>
  <!-- Switch -->
  <div class="switch right" >
    <label>
      Off
      <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L9'] == 1)?'checked':'';?>>
      <span class="lever"></span>
      On
    </label>
  </div>
  <script>
  //switch controller
  function gcheck(a){
  var a;
  var $aa = $("#"+a);
  if($aa.is(":checked"))
  {
  //change th learning status
  $.ajax({
    type : "POST",
    url : "../php/status_change.php",
    data : {
    lesson : "L9", //lesson
    ls : "1" //1 means completed
  },
  dataType : 'html'
  }).done(function(data) {
    //When Successful
    console.log(data);
    if(data == "1")
    {
    console.log("1changed");
    }
    else
    {
    console.log("0still");
    }
  }).fail(function(jqXHR, textStatus, errorThrown) {
  //fail
  alert("Error occur，please check the console log");
    console.log(jqXHR.responseText);
  });
  }
else
{

    $.ajax({
    type : "POST",
    url : "../php/status_change.php",
    data : {
    lesson : "L9",
    ls : "0" //0 means not completed yet
    },
    dataType : 'html'
  }).done(function(data) {

    console.log(data);
    if(data == "0")
    {
    console.log("0changed");
    }
    else
    {
    console.log("1still");
    }
  }).fail(function(jqXHR, textStatus, errorThrown) {

  alert("Error occur，please check the console log");
    console.log(jqXHR.responseText);
  });
}
}
  </script>
</div>
</div>
  </body>
</html>
