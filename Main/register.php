<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
//如過有 $_SESSION['is_login'] 這個值，以及 $_SESSION['is_login'] 為 true 都代表已登入
if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
{
  //直接轉跳到 index.php 後端首頁
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Register</title>
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
    <!-- 頁首 -->
      <?php include_once 'navLR.php'; ?>
    <!-- 網站內容 -->
    <div class="content">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
                  <h1 class="center">Get Start for Free</h1>
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <form class="register"><!-- 沒有設定  method 跟 action 交給之後的 ajax 處理-->
              <div class="form-group">
                <label for="username">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Please input your email address here" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Please input your password here" required>
              </div>
              <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="password" placeholder="Please input your password again" required>
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Please input your name here" required>
              </div>
              <button type="submit" class="btn btn-default">
                Register
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- submit the form -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      //When the dicument is ready，
      $(document).on("ready", function() {
      	//check the useraccount(email) is duplicated or not
      	//check the account by ajax when the input keyup
      	$("#email").on("keyup", function(){
      		//get the value
      		var keyin_value = $(this).val();
      		//when the input keyup and the value is not empty, check the input value
      		if(keyin_value != '')
      		{
      			//$.ajax object
	      		$.ajax({
			        type : "POST",
			        url : "php/check_username.php",
			        data : {
			          email : $(this).val()
			        },
			        dataType : 'html' //the return format is html
			      }).done(function(data) {
			        //if successful
			        //console.log(data); //check point
			        if(data == "yes")
			        {
			        	//if yes, remove the "has-error" class, and then add the "has-success" class
			        	$("#email").parent().removeClass("has-error").addClass("has-success");
			        	//把註冊按鈕 disabled 類別移除，讓他可以按註冊
			        	$("form.register button[type='submit']").removeClass('disabled');
			        }
			        else
			        {
			        	alert("This email has been registered and cannot be registered again.");
			        	$("#email").parent().removeClass("has-success").addClass("has-error");
			        	//把註冊按鈕加上 disabled 不能按，在bootstrap裡 disabled 類別可以讓該元素無法操作
                $("form.register button[type='submit']").addClass('disabled');
			        }

			      }).fail(function(jqXHR, textStatus, errorThrown) {
			      	//失敗的時候
			      	alert("Error occur，please check the console log");
			        console.log(jqXHR.responseText);
			      });
      		}
      		else
      		{
      			//若為空字串，就移除 has-error 跟 has-success 類別
      			$("#email").parent().removeClass("has-success").removeClass("has-error");
      		}

      	});

				//當表單 sumbit 出去的時候
				$("form.register").on("submit", function(){
					//如果密碼與驗證密碼不一樣
					if ($("#password").val() != $("#confirm_password").val()) {
						//把 input 的父標籤 加入 has-error，讓人知道哪個地方有錯誤，作為提醒
						//為何要在父類別加has-error，請看 http://getbootstrap.com/css/#forms-control-validation
						$("#password").parent().addClass("has-error");
						$("#confirm_password").parent().addClass("has-error");
	        	//若密碼都不一樣就警告。
	          alert("Password confirm error, please check again.");//兩次密碼輸入不一樣，請確認

	        }
	        else
	        {
	        	//若當密碼正確無誤，就使用 ajax 送出
	      		$.ajax({
			        type : "POST",
			        url : "php/add_user.php",
			        data : {
			          email : $("#email").val(), //使用者帳號
			          pw : $("#password").val(), //使用者密碼
			          n : $("#name").val() //匿名
			        },
			        dataType : 'html' //設定該網頁回應的會是 html 格式
			      }).done(function(data) {
			        //成功的時候
			        console.log(data);
			        if(data == "yes")
			        {
			          alert("Register successful,\n automatically taken to the login page.");//註冊成功，將自動前往登入頁。
			        	//註冊新增成功，轉跳到登入頁面。
			        	window.location.href="login.php";
			        }
			        else
			        {
			        	alert("Registration failed, \nplease contact the system staff");//註冊失敗，請與系統人員聯繫
			        }

			      }).fail(function(jqXHR, textStatus, errorThrown) {
			      	//失敗的時候
			      	alert("Error occur，please check the console log");
			        console.log(jqXHR.responseText);
			      });
	        }
	        //一樣要回傳 false 阻止 from 繼續把資料送出去。因為會交由上方的 ajax 非同步處理註冊的動作
          return false;
				});
      });
    </script>
    <!-- 頁底 -->
    <?php
      include_once 'footer.php';
    ?>
  </body>
</html>
