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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn09.php" data-position="top" data-tooltip="Go back to Lesson6">
            <i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn10s.php" data-position="top"
            data-tooltip="Click next to see the secure development method.">
            <i class="material-icons right">arrow_forward</i>Secure</a>
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
          Lesson 10: Session Control(Login System)</a>
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
          This is an example of a SESSION uncontrolled website, malicious user can get some sensitive information through a bypass attack or invade an unprotected web page.
<br><br>
Usually most good developers will name files with meaningful words, but this also allows attackers to take advantage of them. The simplest example is that general-based developers usually put the management page in a folder called Admin. At this time, if the web page does not have session control, the attacker can directly guess, or use the browser developer tool to find these hidden web pages or even directly access these web pages that require authentication.

        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>Click the link to the example website.</li>
            <li>try to find the file Adim and go to the backend by attack the url directly.</li>
            <li>replace the login.php to admin/ in the URL line:
            <pre>.../insecure_login/admin/index.php</pre>
              and see what will happen?<br>
              You can get into the backend comtroller page directly without and authentication!
            </li>
            <li>Click the next button to learn how to improve it.</li>
          </ol>
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>
In the secure method
we can use the perfect  SESSION protection mechanism.
Here is an simplest example
this session can be a gate keeper, to protect the sensitive files or data, if someone want to access it without verify the identiry, they will not be availible to get in and will be turn back to the outside(login page).
<pre>
//If there is no value of $ _SESSION ['user_login'], or $ _SESSION ['user_login'] is false, it means no authentication.
if(!isset($_SESSION['user_login']) || !$_SESSION['user_login'])
{
//Jump directly back to login.php
header("Location: ../login.php");
}</pre>
        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->
<div class="col-md-4" id="example">
  <h4>Broken Authenticationn</h4>
  <h5>SESSION uncontroled Login</h5>
  <div class="chip">Insecure Development</div>
  <div class="card indigo lighten-4">
          <div class="card-content">
            <span class="card-title">Insecure Login</span>
            <p>Try to get into the backend of this website, it is possible and easy! And I won't say somentimes developer like put the file in the "admin" folder.</p>
          </div>
          <div class="card-action">
            <a href="../../insecure_login/login.php"  style="color:#512da8;"target="_blank">Link to demo insecure web</a>
          </div>
        </div>
</div>


<!--Code------------------------------------------------------------>

<!--Code Insecure-->
        <div class="col-md-4">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>verify_user.php</a>
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
Nothing for authentication.
Check Secure Method Code, you can find the difference.
            </pre>
          </div>
<!--Code Secure-->
        <div class="col-md-4" id="codeComp" hidden="true">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>verify_user.php</a></li>
            <li role="presentation" ><a>Secure</a></li>
          </ul>
          <style>
          #sourceCode{
            height:70%;
            overflow: scroll;
          }
          </style>

            <pre id="sourceCode">
//If there is no value of $ _SESSION ['user_login'], or $ _SESSION ['user_login'] is false, it means no authentication.
if(!isset($_SESSION['user_login']) || !$_SESSION['user_login'])
{
	//Jump directly back to login.php
	header("Location: ../login.php");
}
            </pre>

        </div>
<!-- Modal Structure -->
<!--Insecure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>verify_user.php<strong style="color:red;">Insecure</strong></h4>
            <pre>
              Nothing for authentication.
              Check Secure Method Code, you can find the difference.
            </pre>

          </div>
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
