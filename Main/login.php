<?php
require_once 'php/db.php';

//if $_SESSION['is_login'] is set or is true， means the user identity verified
if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
{
  //Go to the index.php
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- For mobile devices or flat panel display, depending on the width
    of the device, the initial magnification ratio 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script src='js/jquery-3.3.1.min.js'></script>

    <!-- Compiled and minified CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <!-- Header -->
      <?php include_once 'navLR.php'; ?>
    <!-- Content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <!--http://getbootstrap.com/css/#grid -->
          	<h2 class="text-center">Log In to White Hat Developer</h2>
          <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <form class="login">
              <div class="form-group">
                <label for="username">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Please input your email here" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Please input your password here" required>
              </div>
              <button type="submit" class="btn btn-default">
                Login
              </button>
              <a href="register.php">Register</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Verify_user-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready", function() {
				$("form.login").on("submit", function(){
				  //post the form data to verify_user.php by using ajax
					$.ajax({
            type : "POST",
            url : "php/verify_user.php",
            data : {
              un : $("#email").val(), //user email
              pw : $("#password").val() //user password
            },
            dataType : 'html' //setting the response formet is html
          }).done(function(data) {
            //check point
            console.log(data);
            if(data == "yes")
            {
              window.location.href = "index.php";
            }
            else
            {
              alert("The username or password you entered has not been recognised.\nPlease check your spelling and try again!");
            }
          }).fail(function(jqXHR, textStatus, errorThrown) {

            alert("Error occur，please check the console log");
            console.log(jqXHR.responseText);
          });

          return false;
				});
      });
    </script>
    <!-- Footer -->
    <?php
      include_once 'footer.php';
    ?>
  </body>
</html>
