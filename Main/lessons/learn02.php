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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src='../js/jquery-3.3.1.min.js'></script>
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
          <a class="waves-effect waves-light btn" id="backButton" href="learn01.php"><i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn " id="nextButton" href="learn03.php" data-position="top"
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
        Lesson 2: Introduction of SQL Injection</a>

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
        <span>This is the overview of SQL Injection.
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
          There is no code comparison in Lesson2.
        </span>
      </div>
    </li>
  </ul>
        </div>

<!--example----------------------------------------------------------------------->
        <div class="col-md-8" >
          	<div class="content">
          <h3>SQL Injection:</h3>
          <hr>
          <p>The use of SQL instructions in the input string to carry other SQL instructions,
            in general, is to carry malicious instructions from the legitimate query instructions.
            For example: illegal access to information, malicious destruction of data,
            etc. Therefore, in the design of the program, this basic security must also be taken into account.
            </p>
            <br>
            <p>SQL Injection can be roughly divided into the following categories:</p>
            <ol>
              <li>In-Band:
                <ol type="a">
                  <li>Union-Based SQL Injection - Attack through Union
                    statement.</li>
                  <li>Error-Based SQL Injection - an attack that uses
                    the error message to display subquery results.</li>
                  </ol>
              </li>
              <li>Blind:
                <ol type="a">
                  <li>Boolean-Based SQL Injection - An attack that
                     guesses whether a data character is matched by a
                     conditional expression.</li>
                  <li>Time-Based SQL Injection - Same as above, but with
                     delay time for decision.</li>
                </ol>
              </li>
              <li>Out-of-Band</li>
            </ol>
            <p>In the case of stealing data, the In-Band type is the most dangerous
              because it can display data directly; and Out-of-Band one of the methods
               may allow various actions to insert and delete all data sheets,
               so the risk is very high.</p>

          <!-- Switch -->
          <div class="switch right" >
            <label>
              Off
              <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L2'] == 1)?'checked':'';?>>
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
                    lesson : "L2", //lesson
                    ls : "1" //1 means finished
                  },
                  dataType : 'html' //the return type is html
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
                    lesson : "L2",
                    ls : "0"
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
