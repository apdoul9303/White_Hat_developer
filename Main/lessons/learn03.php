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
    <link rel="stylesheet" href="../css/style.css">
    <script src='../js/learn.js'></script>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>

  <body>
    <!-- nav Top -->
    <?php //include_once 'navTop.php'; ?>
    <nav class="navbar " style="background-color: #26a69ab8;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">White Hat Developer</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="../index.php">Home</a></li>
              <li><a href="../forum/forum.php">Forums</a></li>
              <li><a href="../about.php">About Me</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>
                  <img alt="photo" src="<?php echo ($_SESSION['user_img_path'] != NULL)?'../'.$_SESSION['user_img_path']:'../images/girl.jpeg';?>" class="<?php echo $_SESSION['user_img_css']."-small";?> dropdown-trigger"/>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                  <li><a href="../index.php">Profile</a></li>
                  <li><a href="../forum/article_list.php">My Posts</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li><a href="../php/logout.php">Logout</a></li>
                </ul>
          </div>
        </div>
      </nav>
      <script>
    $('.dropdown-trigger').dropdown();
    	</script>

    <!--nav Botton-->
      <nav class="navbar navbar-default navbar-fixed-bottom">
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn02.php" data-position="top" data-tooltip="Go back to Lesson2">
            <i class="material-icons left">arrow_back</i>Bake </a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn03s.php" data-position="top"
            data-tooltip="Click next to see the secure development method.">
            <i class="material-icons right">arrow_forward</i>Secure</a>
        </div>
        <style>
        nav, nav .nav-wrapper i, nav a.sidenav-trigger, nav a.sidenav-trigger i {
            height: 5%;
        }
        /*左邊button 的距離*/
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
          Lesson 3: In-Band Injection</a>

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
						Here is a basic SQL injection example (take the login system as an example)
						The weak authentication method combined with the logic error caused this vulnerability.
					 When a malicious user enters <pre>'OR ''=''#</pre> or <pre>'OR ''=''-- </pre>(double quotes)
					 in the account section You can log in illegally.
<br><br>
<strong>Causes:</strong><br>
The string that allows the user to enter does not filter the illegal
characters when substituting the SQL query statement, causing the string to
become part of the query,allowing the attacker to execute arbitrary SQL statements.
<br><br>
<strong>Principle:</strong>
"#" and "--" in the SQL instruction represent comments, so the query originally entered is:
"SELECT * FROM `test_sql` WHERE `account` LIKE '".$account."' AND `password` LIKE '".$password."'";
<br><pre>"SELECT * FROM `test_sql` WHERE `account` LIKE '".$account."' AND `password` LIKE '".$password."'";</pre><br>
Will become account field equal to empty or ''='', the following password is commented out:
<br><pre>"SELECT * FROM `test_sql` WHERE `account` LIKE '".$account."'' OR ''=''";</pre><br>
And then the latter condition is true and the SQL instruction will start executing.
</span>
              </div>
            </li>
						<li id="ins">
				      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
				      <div class="collapsible-body" id="textarea">
								<span>
									<ol>
										<li>
											First, try the corrrect username and password
										</li>
										<pre>
username: jolin
password: jolin520</pre>
										<li>
											Then try to attack it by inputting the following instructions in the username input box
											<pre>' OR ''=''#</pre>
										</li>
									</ol>
								</span></div>
            </li>

						<li id="codeComp">
							<div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
							<div class="collapsible-body" id="textarea">
                <span>
					The insecure method:
<br>//use the parameter directly
<pre>
$account = $_REQUEST['account'];

$pass = $_REQUEST['password'];
</pre>

The secure method:<br>
After request the value, fill the special symbol in the username and password by using add addslashes() function.
<br>//before the received parameter add mysqli_real-escape_string($link, $escapestr)
<pre>
$account = mysqli_real-escape_string($link, $_REQUEST['account']);

$pass = mysqli_real-escape_string($link, $_REQUEST['password']);
</pre>
								</span></div>
            </li>
          </ul>
        </div>

<!--example---------------------------------------------->
        <div class="col-md-4" id="example">
          <h3>In-Band Injection</h3>
          <h4>Login System</h4>
          <div class="chip">
            Insecure Development
          </div>
          <form class="login">
            <div class="form-group">
              <label for="username">User name</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Please input your username here" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Please input your password here" required>
            </div>
            <button type="submit" class="btn btn-default">Login</button>
          </form>

        </div>

        <script>
          $(document).on("ready", function() {
            $("form.login").on("submit", function(){
              //For Example (sent the username and password to Verify_user_Demo01S.php by ajax)
              $.ajax({
                type : "POST",
                url : "../php/verify_userDemo01.php",
                data : {
                  un : $("#username").val(),
                  pw : $("#password").val()
                },
                dataType : 'html'
              }).done(function(data) {
                console.log(data);
                //Successful
									//to get the sql query for example
                  $.ajax({
                    type : "POST",
                    url : "../php/getQuery.php",
                    data : {
                      un : $("#username").val(),
                      pw : $("#password").val()
                    },
                    dataType : 'html'
                  }).done(function(sqlQuery) {

                    console.log(sqlQuery);
                    if(data == "yes")
                    {
                      alert("Successful Login!\n\nUsername: "+$("#username").val()+"\nPassword: "+$("#password").val()+"\n\nSQL Query: "+sqlQuery);
                    }
                    else
                    {
                      alert("The username or password you entered has not been recognised.\nPlease check your spelling and try again!\n\nUsername: "+$("#username").val()+"\nPassword: "+$("#password").val()+"\n\nSQL Query: "+sqlQuery);
                    }
									});

              }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("Error occur，please check the console log");
                console.log(jqXHR.responseText);
              });
              //return false to prevent the form sent again.
              return false;
            });
          });
        </script>



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
						width:400px;
						height:435px;
						overflow: scroll;
					}
					</style>

						<pre id="sourceCode">
							<a  id="zoomIn"class="waves-effect waves-light btn modal-trigger btn-floating right"
							style="position:fixed; right:30px;" href="#modal1">
								<i class="material-icons">zoom_in</i>
							</a>
$username = $_REQUEST['username'];
$pass = $_REQUEST['password'];


$password = md5($pass);

$sql = "SELECT * FROM `user` WHERE `username` LIKE '".$username."
' AND `password` LIKE '".$password."'";
$res = mysqli_query($_SESSION['link'],$sql);

$result = mysqli_fetch_array($res);
if(empty($result)){
//If there is no username matched, show the message.
echo "The username or password you
entered has not been recognised. Please check your
spelling and try again ";
}
else
{
//If there is no username matched, show "successful login"

echo "Successful Login!";
}
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
                      <a  id="zoomIn"class="waves-effect waves-light btn modal-trigger btn-floating right"
                      style="position:fixed; right:30px;" href="#modal1">
                        <i class="material-icons">zoom_in</i>
                      </a>
  $username = mysqli_real-escape_string($link,$_REQUEST['un']);
  $pass = mysqli_real-escape_string($link,$_REQUEST['pw']);


  $password = md5($pass);

  $sql = "SELECT * FROM `user` WHERE `username` LIKE '".$username."
          ' AND `password` LIKE '".$password."'";
  $res = mysqli_query($_SESSION['link'],$sql);

  $result = mysqli_fetch_array($res);
  if(empty($result)){
    //If there is no username matched, show the message.
    echo "The username or password you
    entered has not been recognised. Please check your
    spelling and try again ";
  }
  else
  {
    //If there is no username matched, show "successful login"

    echo "Successful Login!";
  }

                    </pre>

                </div>
<!-- Modal Structure -->
<!--Secure-->
                <div id="modal1" class="modal">
                  <div class="modal-content">
                    <h4>verify_user.php<strong style="color:red;">Insecure</strong></h4>
                    <pre>

	$username = $_REQUEST['username'];
	$pass = $_REQUEST['password'];


	$password = md5($pass);

	$sql = "SELECT * FROM `user` WHERE `username` LIKE '".$username."
	        ' AND `password` LIKE '".$password."'";
	$res = mysqli_query($_SESSION['link'],$sql);

	$result = mysqli_fetch_array($res);
	if(empty($result)){
	  //If there is no username matched, show the message.
	  echo "The username or password you
	  entered has not been recognised. Please check your
	  spelling and try again ";
	}
	else
	{
	  //If there is no username matched, show "successful login"

	  echo "Successful Login!";
	}
                    </pre>

                  </div>
                  <div class="modal-footer">
                    <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
                  </div>
                </div>
  </body>
</html>
