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
          <<a class="waves-effect waves-light btn disabled" id="backButton"><i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn02.php" data-position="top"
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
        Lesson 1: Overall Introduction </a>

          <style>
          a#list{
            vertical-align: top;
            color: green;
          }
            #textarea{
              /*width:400px;*/
              max-height:50%;
              overflow: scroll;
            }
          </style>
          <ul class="collapsible">
    <li id="learn"class="active">
      <div class="collapsible-header"><i class="material-icons">import_contacts</i>Learn</div>
      <div class="collapsible-body" id="textarea">
        <span>This area will provide a brief introduction to the vulnerability first,
          as well as the reason why it will occur, includes its principle and explain
          how the improved method of defence.
        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>Here will provide with some attack instructions to interact with the examples on the website.
          And teach you how to observe changes in the web.
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>Click here to see a comparison of the two development methods (insecure and
          improved), and you clearly compare the differences between the two development
          methods.
        </span>
      </div>
    </li>
  </ul>
        </div>

<!--example----------------------------------------------------------------------->
        <div class="col-md-4" id="example">
          <h3>Overall Introduction</h3>
          <h4>Example</h4>
          <div class="chip">
            Insecure Development
          </div>
          <div class="chip" style="color:green;">
            Secure Development
          </div>
          <p> In each lesson, this area will provide two examples. First is the
            insecure example and after click "next" button, there will be a secure one that design by using
            the improved methods here.
            <br><br>
            You can try to attack the both examples which are designed by different development
            methods, and to see what is the difference.
          </p>

          <p>If you finish each lesson, don't forget to turn on the switch.
          This switch will help you to trace and check your learning rate of progress,
          and it will automatically record your learning status on your Dash Board. </p>

          <!-- Switch -->
          <div class="switch right" >
            <label>
              Off
              <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L1'] == 1)?'checked':'';?>>
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
          lesson : "L1", //lesson
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
          lesson : "L1",
          ls : "0" //0 means not finished yet
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
<!--Code------------------------------------------------------------>

<!--Code Insecure-->
        <div class="col-md-4">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>example.php</a>

            </li>

            <li role="presentation" ><a>Insecure</a></li>
          </ul>
          <style>
          #sourceCode{
            height:70%;
            overflow: scroll;
          }
          </style>

            <pre id="sourceCode">
              <a id="zoomIn"class="waves-effect waves-light btn modal-trigger btn-floating right"
              style="position:fixed; right:30px;" href="#modal1">
                <i class="material-icons">zoom_in</i>
              </a>
Here will show the developemnt methods
as the source code.
You can observe the code here and even
try the methods on your own editer by
following it.

click the zoom_in icon on the top right
side to help you get a bigger area to see
these code clearly.
</pre>
          </div>
<!--Code Secure-->
        <div class="col-md-4" id="codeComp" hidden="true">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>verify_user.php</a></li>
            <li role="presentation" ><a>Secure</a></li>
          </ul>

            <pre id="sourceCode">

Here will show the secure developemnt
methods as the source code.

When you clock "Code Comparison" to
compare two methods, the secure code
will always in the right side, and
the insecure one wull be in the left side.

You can observe and compare two code of
the methods in the same page.

            </pre>

        </div>
<!-- Modal Structure -->
<!--Insecure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>verify_user.php<strong style="color:red;">Insecure</strong></h4>
            <pre>

        This model will provide you a bigger area to show the code,
        and you can read the whole code more clearly.

        click "close" to close this model.
            </pre>
          </div>
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
