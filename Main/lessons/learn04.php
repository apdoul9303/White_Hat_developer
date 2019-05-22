<?php
//load and connect the database
require_once '../php/db.php';
//If there are no the value of $_SESSION['is_login']or $_SESSION['is_login'] equals false ,
//means user identity not verifed
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

//insecure
if(empty($_GET{'id'})){
  $id = '1';
}else{
  $id = $_GET['id'];
}
$sql = 'SELECT * FROM demo WHERE id ='.$id;
$query = mysqli_query($_SESSION['link'],$sql);
if($query):
  $result =  mysqli_fetch_assoc($query);
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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn03.php" data-position="top" data-tooltip="Go back to Lesson3">
            <i class="material-icons left">arrow_back</i>Bake</a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn04s.php?id=1" data-position="top"
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
<?php include_once 'navSide.php';?>

      <!--Content-->
        <div class="col-md-4">
          <a id="list"href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">format_list_numbered</i>
            Lesson 4: Union-Based Injection</a>
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
          This page "expected user input id must be an integer", so when the user enters non-integer data,an error occurs and a completely blank result is obtained.
          Because the expected id is an integer relationship, the web page directly concatenates the id parameter into the SQL statement.
          When the attacker tries to enter "-9527 OR 1=1", something interesting happens.
          Why is it a wrong id, but we still get the message?<br>
          The reason is very simple, because "OR 1=1" becomes part of the SQL statemen.<br>
          So the real Sql query will look like this:<br>
          <pre>SELECT * FROM demo WHERE id=-9527 OR 1=1</pre><br>
          This means everything after id is true, so it will work as normal.<br><br>

          What's more serious is that if you put a <strong>UNION statement</strong> and a data sheet corresponding to the guess,
          you can easily get any information.<br><br>
          Now, If I am the hacker,and I guess the article's table is like this:<br>
          <img style="width:70%"src="../images/table_demo.jpg"/><br>
          Then I guess the table for user data is like this:<br>
          <img style="width:70%"src="../images/table_users.jpg"/><br>
          If the format of these two data tables and the number of column in these two data tables is the same.
          I can then use the SQL UNION statement to illegally obtain other users' username and password!
        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>First, observe the number after <strong>?id=</strong> in the url </li>
            <li>Next, id=1 which means to get the data from table which id = 1
              and there are two data in this table, so try to change the id=2 and
              you will get the message 2.</li>
              <li>then try to attack it by inputting the following instructions replace
                the index number after id=
              </li>
            <pre>-9527 OR 1=1</pre><br>
            <pre>-1 UNION SELECT id,username,password FROM users</pre>
            <li>See waht will it happen, and then click button to the secure method.</li>
            </ol>
        </span>
      </div>
    </li>

    <li id="codeComp">
      <div class="collapsible-header"><i class="material-icons">code</i>Code Comparison</div>
      <div class="collapsible-body" id="textarea">
        <span>
<strong>PHP MySQL Prepared Statements</strong><br>
A prepared statement (also known as the parameterized statement) is simply a SQL query template containing placeholder instead of the actual parameter values. These placeholders will be replaced by the actual values at the time of execution of the statement.

MySQLi supports the use of anonymous positional placeholder (?), as shown below:<br>

<pre>
INSERT INTO persons (first_name, last_name, email) VALUES (?, ?, ?);</pre>

While, PDO supports both anonymous positional placeholder (?), as well as the named placeholders. A named placeholder begins with a colon (:) followed by an identifier, like this:
<br>
<pre>
INSERT INTO persons (first_name, last_name, email)
VALUES (:first_name, :last_name, :email);</pre>
<br><br>

The prepared statement execution consists of two stages: prepare and execute.<br><br>

<strong>Prepare</strong>— At the prepare stage a SQL statement template is created and sent to the database server. The server parses the statement template, performs a syntax check and query optimization, and stores it for later use.
<br><strong>Execute</strong> — During execute the parameter values are sent to the server. The server creates a statement from the statement template and these values to execute it.
<br>Prepared statements are very useful, particularly in situations when you execute a particular statement multiple times with different values, for example, a series of INSERT statements. The following section describes some of the major benefits of using it.

<hr>
Find more information about Prepared Statements:<a href="https://www.tutorialrepublic.com/php-tutorial/php-mysql-prepared-statements.php" target="_blank">Link</a>


        </span>
      </div>
    </li>
  </ul>
</div>

<!--example----------------------------------------------------------------------->
<div class="col-md-4" id="example">
  <h4>Union-Based Injection</h4>
  <h4>Artical List</h4>
  <div class="chip">
    Insecure Development
  </div>
  <br>
  <form class="login" action="" >
    <div class="form-group">
      <label for="password">Artical:  </label>
      <?php echo $result['article'];?>
    </div>
    <div class="form-group">
      <label for="password">Author:  </label>
      <?php echo $result['author'];?>
      <br>

    </div>
  <?php else:
          echo "{$sql} error message：" . mysqli_error($_SESSION['link']);
        endif;
  ?>

  </form>

</div>


<!--Code------------------------------------------------------------>

<!--Code Insecure-->
        <div class="col-md-4" id="codeComp" hidden="true">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>article.php</a>
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
if(empty($_GET{'id'})){
  $id = '1';
}else{
  $id = $_GET['id'];
}
$sql = 'SELECT * FROM demo WHERE id ='.$id;

$query = mysqli_query($_SESSION['link'],$sql);
if($query){
  $result =  mysqli_fetch_assoc($query);
  echo $result['article'];
  echo $result['author'];
}
            </pre>
          </div>
<!--Code Secure-->
        <div class="col-md-4" >
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a>article.php</a></li>
            <li role="presentation" ><a>Secure</a></li>
          </ul>
          <style>
          #sourceCode{
            height:70%;
            overflow: scroll;
          }
          </style>

            <pre id="sourceCode">

$sql = 'SELECT * FROM demo WHERE id = ?';
///mysqli_prepare
$stmt = mysqli_prepare($_SESSION['link'],$sql);

mysqli_stmt_bind_param($stmt,"i",$id);
if(empty($_GET{'id'})){
  $id = '1';
}else{
  $id = $_GET['id'];
}
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt,$id,$message,$author);
if(mysqli_stmt_affected_rows($stmt)==1):
  while(mysqli_stmt_fetch($stmt)){
    $list['messqge']=$message;
    $list['author']=$author;
  }
            </pre>

        </div>
<!-- Modal Structure -->
<!--Insecure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>article.php<strong style="color:red;">Insecure</strong></h4>
            <pre>
              if(empty($_GET{'id'})){
                $id = '1';
              }else{
                $id = $_GET['id'];
              }
              $sql = 'SELECT * FROM demo WHERE id ='.$id;

              $query = mysqli_query($_SESSION['link'],$sql);
              if($query){
                $result =  mysqli_fetch_assoc($query);
                echo $result['article'];
                echo $result['author'];
              }
            </pre>

          </div>
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
