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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn06.php" data-position="top" data-tooltip="Go back to Lesson6">
            <i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn07s.php" data-position="top"
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
          Lesson 7: DOM-Based XSS</a>
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
What is DOM? The DOM is called the Document Object Model, which is used to describe the representation of HTML files. It allows us to dynamically generate complete web pages using JavaScript without having to go through a server.
<br><br>
Therefore, DOM-Based XSS refers to the JavaScript on the web page. During the execution process, there is no detailed inspection data, so the process of operating the DOM is substituted for malicious instructions.
<br><br>
If you do not properly check the content, any content you enter will be created as a valid DOM object, and the embedded code will be executed.
<br><br>
But this way, unless the attacker personally enters the victim's computer, it is impossible for the victim to enter the malicious code. Therefore, it is usually necessary to match the first two methods. Let content be stored in a server repository, or create content in a reflective fashion, and then use JavaScript to dynamically generate valid DOM objects to run malicious code.

        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>input your name in the box, and the web will say Hi! to you.</li>
            <li>attack it by input the following script:
<br>
<pre>&lt;img src=# onerror="alert(123)"></pre>
this script will inject an imag type into the html document and occur an alert.
<br>
An alert will occur which means you successfully attack it.
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
Here you should use " innerText ", when you use this property to insert a string, it will be guaranteed as pure text, and it will not be inserted into malicious code.
        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->
<div class="col-md-4" id="example">
  <h3>DOM-Based XSS</h3>
  <div class="chip">Insecure Development</div>
  <script>
    var creat_text = function(){
      var name = document.getElementById('name').value;
      document.getElementById('show_name').innerHTML = name;
    }
  </script>
  <h3>Hi, <span id="show_name"></span></h3>

    <div class="form-group">
      <label >Name: </label>
      <input id="name" type="text"/>
      <button onclick="creat_text()">Say Hi</button>
  </div>
</div>


<!--Code------------------------------------------------------------>

<!--Code Insecure-->
        <div class="col-md-4">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>DOM-Based_XSS.php</a>
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
&lt;script>
  var creat_text = function(){
    var name = document.getElementById('name').value;
    document.getElementById('show_name').innerHTML = name;
  }
&lt;/script>
            </pre>
          </div>
<!--Code Secure-->
        <div class="col-md-4" id="codeComp" hidden="true">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>DOM-Based_XSS.php</a></li>
            <li role="presentation" ><a>Secure</a></li>
          </ul>
          <style>
          #sourceCode{
            height:70%;
            overflow: scroll;
          }
          </style>

            <pre id="sourceCode">
&lt;script>
  var creat_text = function(){
    var name = document.getElementById('name').value;
    document.getElementById('show_name').innerText = name;
  }
&lt;/script>
            </pre>

        </div>
<!-- Modal Structure -->
<!--Insecure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>DOM-Based_XSS.php<strong style="color:red;">Insecure</strong></h4>
            <pre>
&lt;script>
  var creat_text = function(){
    var name = document.getElementById('name').value;
    document.getElementById('show_name').innerHTML = name;
  }
&lt;/script>
            </pre>

          </div>
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
