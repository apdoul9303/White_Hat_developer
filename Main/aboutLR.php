<?php
//require_once 'php/db.php';

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>About Me</title>
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
		<?php include_once 'menuLR.php'; ?>
    <!-- Content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-md-6">
                <h1>Contact</h1>
                <p>
                  This website is designed for my master dissertation in 2018.<br>
I hope you enjoy the lessons and if you find any problems with this website, please contact me.
                </p>
              </div>
              <div class="col-md-6">
                <h1>Tingyu Liu</h1>
                <p>
                  University of Southampton<br>

                  email：<a href="mailto:tyl2y17@soton.ac.uk">tyl2y17@soton.ac.uk</a>

                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>
  </body>
</html>
