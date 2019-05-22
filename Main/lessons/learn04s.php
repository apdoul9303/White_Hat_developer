<?php
//load and connect the database
require_once '../php/db.php';
//If there are no the value of $_SESSION['is_login']or $_SESSION['is_login'] equals false ,
//means user identity not verifed
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}
//Secure
$sql = 'SELECT * FROM demo WHERE id = ?';
///mysqli_prepare: prepare the format
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
          <a class="waves-effect waves-light btn tooltipped" id="backButton" href="learn04.php?id=1" data-position="top" data-tooltip="Go back to insecure methods">
            <i class="material-icons left">arrow_back</i>Insecure </a>
          <a class="tooltipped waves-effect waves-light btn tooltipped" id="nextButton" href="learn05.php" data-position="top"
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
There are two ways to resolve this type of illegal login:
<ol>
	<li>mysqli_real_escape_string function (not recommended)</li><br>

Just use the function to filter the parameters to be stringed before the parameter is inserted into the SQL statement. It will replace all the keyword elements of the SQL with the skip character, making it an ordinary word in the SQL query. String, not part of the statement. As you can see from the results, real_escape_string filters the single quotes into a string of "\'".
<br>But this can only deal with the fields that belong to the string in the database. The fields for numbers can be used with the is_numeric function.
<br>
<li>Prepared Statement (recommended)</li><br>

This is the most recommended practice, because it can solve the problem of SQL Injection fundamentally, unless it is a function that comes with PHP official itself. The Prepared Statement will preprocess the SQL statement, and then use the bindValue or bindParam function provided by it to bind the value or variable of the parameter to be queried. When the underlying query is executed, its parameters are guaranteed to be passed as numeric values, and it is impossible to become a SQL statement. <br>As part of it, there is no problem with SQL Injection.
<br>Even if you enter the wrong parameter, no error will occur, only the query will fail and you will get an empty result.
<br>Most web-based back-end languages ​​provide a similarly-prepared Prepared Statement mechanism, so it's highly recommended that you take the time to find out if there is a similar feature available in any language.

        </span>
      </div>
    </li>
    <li id="ins">
      <div class="collapsible-header"><i class="material-icons">dvr</i>Instructions</div>
      <div class="collapsible-body" id="textarea">
        <span>
          <ol>
            <li>Try to attack it  again by inputting the following instructions replace the index number after id=</li>
            <pre>-9527 OR 1=1</pre><br>
            <pre>-1 UNION SELECT id,username,password FROM users</pre>
            <li>check the code(code comparison) and then turn on the switch and go to the next lesson.</li>
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
  <h4>Article List</h4>
  <div class="chip" style="color:Green;">
  Secure Development</div>
  <br>
  <?php if(mysqli_stmt_affected_rows($stmt)==1):
    while(mysqli_stmt_fetch($stmt)){
          $list['article']=$message;
          $list['author']=$author;
        //  $list_merge[]=$list;
     }?>
  <form class="login" >
    <div class="form-group">
      <label for="password">Article:  </label>
    <?php  echo $list['article'];?>
    </div>
    <div class="form-group">
      <label for="password">Author:  </label>
      <?php echo $list['author'];?>
      <br>
      <br>
    </div>
    </form>
  <?php else:?>
    <h4 style="color:red;"><?php  echo "Select fail!"; ?></h4>
        <form class="login" >
          <div class="form-group">
            <label for="password">Message:  </label>

          </div>
          <div class="form-group">
            <label for="password">Author:  </label>

            <br>
            <br>
          </div>
          </form>
  <?php endif;?>

  <!-- Switch -->
  <div class="switch right" >
    <label>
      Off
      <input type="checkbox" id="switch" onchange="gcheck('switch')" <?php echo ($_SESSION['user_L4'] == 1)?'checked':'';?>>
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
    lesson : "L4", //lesson
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
    lesson : "L4",
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
<!--Secure-->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>article.php<strong style="color:red;">Insecure</strong></h4>
            <pre>
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
          <div class="modal-footer">
            <a href="javascript:void(0);" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
  </body>
</html>
