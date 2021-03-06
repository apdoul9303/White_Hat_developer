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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn06.php" data-position="top" data-tooltip="Go back to insecure methods">
            <i class="material-icons left">arrow_back</i>Insecure </a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn07.php" data-position="top"
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
<?php include_once 'navSide.php';?>

      <!--Content-->
        <div class="col-md-4">
          <a id="list"href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">format_list_numbered</i>
          Lesson 6: Reflected XSS</a>
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
Stored, Reflected types must be protected by the backend, in addition to the necessary HTML code, any content that allows the user to enter need to check, delete all "&lt;script>", "onerror=" and any other words that may execute code string.
        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>

            <li>Attack it by inputing the following script again:
<br>
<pre>&lt;script>alert(123)&lt;/script></pre>
what’s the different?<br>
The script will become the normal string.
</li>
            <li>Check the code(code comparison).</li>
            <li>Tern turn on the switch and go to the next lesson.</li>
          </ol>
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>
					This is an example that PHP prevents XSS cross-site scripting attacks: it is for illegal HTML code including single and double quotes, etc., using the htmlspecialchars() function.

					<br><br>When using the htmlspecialchars() function, pay attention to the second parameter. If you use htmlspecialchars($string) directly, the second parameter defaults to ENT_COMPAT. The function simply converts double quotes ("), not escaping single quotes (').

					<br><br>Therefore, the htmlspecialchars function should add the second parameter more often, which should be used like this: htmlspecialchars($string,ENT_QUOTES). Of course, if you need to convert the quotes, use htmlspecialchars($string,ENT_NOQUOTES).

					<br><br>In addition, try to use htmlentities as less as possible. In all English, there is no difference between htmlentities and htmlspecialchars, but you can achieve the goal. However, in Chinese, htmlentities will convert all html code, together with the Chinese characters it cannot recognize.

        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->
<div class="col-md-4" id="example">
  <h3>Reflected XSS</h3>
  <div class="chip" style="color:green;">Secure Development</div>
  <?php if(isset($_GET['name'])):?>
  <h3>Hi, <?= htmlspecialchars($_GET['name'],ENT_QUOTES); ?></h3>
  <input type ="button" onclick="javascript:location.href='learn06s.php'" value="Refresh"></input>
  <?php else: ?>
  <h5>What's your name?</h5>
  <form method="get" >
    <div class="form-group">
      <label >Name: </label>
      <input type="text" class="form-control"  name="name" placeholder="input your name " required>
    </div>
    <button type="submit" class="btn btn-default">
      Say Hi
    </button>
  </form>
  <?php endif; ?>


  <!-- Switch -->
  <div class="switch right" >
    <label>
      Off
      <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L6'] == 1)?'checked':'';?>>
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
    lesson : "L6", //lesson
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
    lesson : "L6",
    ls : "0" //0 means is not finish yet
    },
    dataType : 'html' //設定該網頁回應的會是 html 格式
  }).done(function(data) {
  //成功的時候
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
  //失敗的時候
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
            <li role="presentation" class="active"><a>reflectedXss.php</a>
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
&lt;?php if(isset($_GET['name'])):?>
&lt;h3>Hi, &lt;?php echo $_GET['name']; ?>&lt;/h3>
&lt;?php else: ?>
&lt;h5>What's your name?&lt;/h5>
&lt;form method="get" >
  &lt;div class="form-group">
    &lt;label >Name: &lt;/label>
    &lt;input type="text" class="form-control"  name="name"
    placeholder="input your name " required>
  &lt;/div>
  &lt;button type="submit" class="btn btn-default">
    Say Hi
  &lt;/button>
&lt;/form>
&lt;?php endif;?>
            </pre>
          </div>
<!--Code Secure-->
        <div class="col-md-4" >
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>reflectedXss.php</a></li>
            <li role="presentation" ><a>Secure</a></li>
          </ul>
          <style>
          #sourceCode{
            height:70%;
            overflow: scroll;
          }
          </style>

            <pre id="sourceCode">

&lt;?php if(isset($_GET['name'])):?>
&lt;h3>Hi, &lt;?php echo htmlspecialchars($_GET['name'],ENT_QUOTES); ?>&lt;/h3>
&lt;?php else: ?>
&lt;h5>What's your name?&lt;/h5>
&lt;form method="get" >
  &lt;div class="form-group">
    &lt;label >Name: &lt;/label>
    &lt;input type="text" class="form-control"  name="name"
    placeholder="input your name " required>
  &lt;/div>
  &lt;button type="submit" class="btn btn-default">
    Say Hi
  &lt;/button>
&lt;/form>
&lt;?php endif;?>
            </pre>

        </div>
<!-- Modal Structure -->
<!--Secure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>reflectedXss.php<strong style="color:green;">Secure</strong></h4>
            <pre>
&lt;?php if(isset($_GET['name'])):?>
&lt;h3>Hi, &lt;?php echo htmlspecialchars($_GET['name'],ENT_QUOTES); ?>&lt;/h3>
&lt;?php else: ?>
&lt;h5>What's your name?&lt;/h5>
&lt;form method="get" >
  &lt;div class="form-group">
    &lt;label >Name: &lt;/label>
    &lt;input type="text" class="form-control"  name="name"
    placeholder="input your name " required>
  &lt;/div>
  &lt;button type="submit" class="btn btn-default">
    Say Hi
  &lt;/button>
&lt;/form>
&lt;?php endif;?>
            </pre>

          </div>
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
