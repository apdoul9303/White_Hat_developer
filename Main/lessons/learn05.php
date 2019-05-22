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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn04.php?id=1"
          data-position="top" data-tooltip="Go back to Lesson4"><i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn06.php" data-position="top"
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
        Lesson 5: Introduction of Cross-Site Scripting</a>

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
        <span>This is the overview of Cross-Site Scripting.
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
          There is no code comparison in Lesson5.
        </span>
      </div>
    </li>
  </ul>
        </div>

<!--example----------------------------------------------------------------------->
        <div class="col-md-8" >
          	<div class="content">
          <h3>Cross-Site Scripting:</h3>
          <hr>
          <p>Compared with the vulnerability in the language itself, it is easier to be ignored
            by developers without checking the input content, and even throwing the filtered
            part to the client for processing.
            </p>
            <br>
            <p>XSS attacks can be roughly divided into the following types:</p>
            <ul>
              <li><strong>Stored XSS (storage type):</strong><br>
              The attack caused by the JavaScript code stored in the server database is
              the Stored XSS. The most common ones are forum articles, message boards, etc.,
               because the user can input any content. If there is no check, the user input is as Keywords such as
               <per> <</pre>script> will be executed as normal HTML, and the contents of the tag will be executed as
                 JavaScript code.</li>
              <li><strong>Reflected XSS (reflective):</strong><br>
              Reflected means that it will not be stored in the database, but will be directly embedded in the content
              transmitted by the front-end user. The most common is that the server does not check when the data is sent
               to the server by the GET method. Respond to the vulnerability generated by the content on the web page.
             </li>
              <li><strong>DOM-Based XSS (DOM-based type):</strong><br>
                The DOM is called the Document Object Model, which is used to describe the representation of HTML files.
                 It allows us to dynamically generate complete web pages using JavaScript without having to go through a
                  server.<br>Therefore, DOM-Based XSS refers to the JavaScript on the web page. During the execution
                  process, there is no detailed inspection data, so the process of operating the DOM is substituted for
                  malicious instructions.
              </li>
							<div class="switch right"  style="margin-button:10%">
		            <label>
		              Off
		              <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L5'] == 1)?'checked':'';?>>
		              <span class="lever"></span>
		              On
		            </label>
		          </div>
            </ul>
          <!-- Switch -->

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
                    lesson : "L5", //lesson
                    ls : "1" //1 means is finished
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
                    lesson : "L5",
                    ls : "0" //0 means is not finished yet
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
