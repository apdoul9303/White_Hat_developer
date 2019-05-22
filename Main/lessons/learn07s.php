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
					<a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn07.php" data-position="top" data-tooltip="Go back to insecure methods">
            <i class="material-icons left">arrow_back</i>Insecure </a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn08.php" data-position="top"
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
DOM-Based must be guarded by the front end, but basically the same as the previous principle.
<br><br>
The correct method and property should be chosen to operate the DOM. For example, the main reason for the vulnerability in the previous example is the "innerHTML" attribute in "document.getElementById('show_name').innerHTML = name; ", which represents the inserted The content is a legal HTML string, so the string is parsed into a DOM object.
<br><br>
Here you should use " innerText ", when you use this property to insert a string, it will be guaranteed as pure text, and it will not be inserted into malicious code.

        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>Attack it by input the following script again:
<br>
<pre>&lt;img src=# onerror="alert(123)"></pre>
What is the difference? This script will shows as the plain text.
<br>
An alert will occur which means you successfully attack it.
</li>
            <li>Check the code(code comparison).</li>
						<li>Then turn on the switch and go to the next lesson.</li>
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
  <div class="chip" style="color:green;">Secure Development</div>
  <script>
    var creat_text = function(){
      var name = document.getElementById('name').value;
      document.getElementById('show_name').innerText  = name;
    }
  </script>
  <h3>Hi, <span id="show_name"></span></h3>

    <div class="form-group">
      <label >Name: </label>
      <input id="name" type="text"/>
      <button onclick="creat_text()">Say Hi</button>
  </div>
  <!-- Switch -->
  <div class="switch right" >
    <label>
      Off
      <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L7'] == 1)?'checked':'';?>>
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
    lesson : "L7", //lesson
    ls : "1" //1 means finished
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
    //使用 ajax 送出 是哪一個課程跟完成狀態
    $.ajax({
    type : "POST",
    url : "../php/status_change.php",
    data : {
    lesson : "L7",
    ls : "0" //0 means not finished
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
        <div class="col-md-4" id="codeComp" hidden="true">
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
        <div class="col-md-4">
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
            <h4>DOM-Based_XSS.php<strong style="color:green;">Secure</strong></h4>
            <pre>
&lt;script>
  var creat_text = function(){
    var name = document.getElementById('name').value;
    document.getElementById('show_name').innerText = name;
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
