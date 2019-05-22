<?php
require_once '../php/db.php';

if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	header("Location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Add Article</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- For mobile devices or flat panel display, depending on the width
		of the device, the initial magnification ratio 1 -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- load bootstrap css -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<script src='../js/jquery-3.3.1.min.js'></script>

		<!-- Compiled and minified CSS-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- Compiled and minified JavaScript-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

		<link rel="shortcut icon" href="../images/favicon.ico">
		<link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <!-- Header -->
	  <?php include_once 'menu.php'; ?>

    <!-- Content -->
    <div class="content">
      <div class="container">
        <!-- First Row -->
        <div class="row">
          <div class="col-xs-12">
            <form id="add_article_form">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="input" class="form-control" id="title">
              </div>
               <div class="form-group">
                <label for="category">Category</label>
                <select id="category" class="form-control">
                  <option value="Injection">Injection</option>
                  <option value="Cross-site Scripting">Cross-site Scipting</option>
									<option value="Broken Authentication">Broken Authentication</option>
									<option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea type="input" class="form-control" id="content"></textarea>
              </div>
              <div class="form-group">
								<label>
					        <input class="with-gap" type="radio"  name="publish" value="1"/>
					        <span>Publish</span>
				      	</label>
								<label>
									<input class="with-gap" type="radio"  name="publish" value="0"/>
									<span>No Publish</span>
								</label>

              </div>
              <button type="submit" class="btn btn-default">Submit</button>
              <div class="loading text-center"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php'; ?>

		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script>
			$(document).on("ready", function(){
				//表單送出
				$("#add_article_form").on("submit", function(){
					//加入loading icon
					$("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

					if($("#title").val() == '' || $("#content").val() == ''){
						alert("Please fill in the title or content");

						//清掉 loading icon
						$("div.loading").html('');
					}else{
						//使用 ajax 送出 帳密給 verify_user.php
						$.ajax({
							type : "POST",
							url : "../php/add_article.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
							data : {
								title : $("#title").val(), //使用者帳號
								category : $("#category").val(), //使用者帳號
								content : $("#content").val(), //使用者帳號
								publish : $("input[name='publish']:checked").val() //使用者密碼
							},
							dataType : 'html' //設定該網頁回應的會是 html 格式
						}).done(function(data) {
							//成功的時候

							if(data == "yes")
							{
								//註冊新增成功，轉跳到登入頁面。
								alert("The update is successful, click to confirm the list back");
								window.location.href = "forum.php?c=1";
							}
							else
							{
								alert("Update error");
							}

						}).fail(function(jqXHR, textStatus, errorThrown) {
							//失敗的時候
							alert("Error occur，please check the console log");
							console.log(jqXHR.responseText);
						});
					}
					return false;
				});
			});
			</script>
  </body>
</html>
