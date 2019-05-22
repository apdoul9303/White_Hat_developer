<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once 'php/db.php';
//print_r($_SESSION); //查看目前session內容

//如過沒有 $_SESSION['is_login'] 這個值，或者 $_SESSION['is_login'] 為 false 都代表沒登入
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
  //直接轉跳到 login.php
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>WHD: Upload Photo</title>
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
    <?php
      include_once 'menu.php';
 ?>

    <!-- 網站內容 -->
    <div class="content">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <form id="add_article_form">

              <div class="form-group">
                <label for="category">Upload File(gif/fpeg/png)</label>
                <input type="file" name="image_path" accept="image/gif, image/jpeg, image/png">
                <input type="hidden" id="image_path" value="">
                <div class="image"></div>
                <a href='javascript:void(0);' class="del_image btn btn-default">Delete File</a>
              </div>
              <div class="form-group">
                <label>
                  <input class="with-gap" type="radio"  name="img_css" value="circular-portrait"/>
                  <span>Vertical-rectangle</span>
                </label>
                <label>
                  <input class="with-gap" type="radio"  name="img_css" value="circular-landscape"/>
                  <span>Horizontal-rectangle</span>
                </label>
                <label>
                  <input class="with-gap" type="radio"  name="img_css" value="circular-portrait"/>
                  <span>Square</span>
                </label>
              </div>

              <button type="submit" class="btn btn-default">
                Save
              </button>
              <div class="loading text-center"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php
      include_once 'footer.php';
 ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready", function() {
        /**
         * 圖片上傳
         */
        //上傳圖片的input更動的時候
        $("input[name='image_path']").on("change", function() {
          //產生 FormData 物件
          var file_data = new FormData(),
              file_name = $(this)[0].files[0]['name'],
              save_path = "files/images/";

          //在圖片區塊，顯示loading
          $("div.image").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

          //FormData 新增剛剛選擇的檔案
          file_data.append("file", $(this)[0].files[0]);
          file_data.append("save_path", save_path);
          //透過ajax傳資料
          $.ajax({
            type : 'POST',
            url : 'php/upload_file.php',
            data : file_data,
            cache : false, //因為只有上傳檔案，所以不要暫存
            processData : false, //因為只有上傳檔案，所以不要處理表單資訊
            contentType : false, //送過去的內容，由 FormData 產生了，所以設定false
            dataType : 'html'
          }).done(function(data) {
            console.log(data);
            //上傳成功
            if (data == "yes") {
              //將檔案插入
              $("div.image").html("<img src='" + save_path + file_name + "'>");
              //給予 #image_path 值，等等存檔時會用
              $("#image_path").val(save_path + file_name);
            } else {
              //警告回傳的訊息
              alert(data);
            }

          }).fail(function(data) {
            //失敗的時候
            alert("Error occur，please check the console log");
            console.log(jqXHR.responseText);
          });
        });


        /**
         * 刪除照片
         */
        $("a.del_image").on("click", function() {
          //如果有圖片路徑，就刪除該檔案
          if ($("#image_path").val() != '') {
            //透過ajax刪除
            $.ajax({
              type : 'POST',
              url : 'php/del_file.php',
              data : {
                "file" : $("#image_path").val()
              },
              dataType : 'html'
            }).done(function(data) {
              console.log(data);
              //上傳成功
              if (data == "yes") {
                //將圖片標籤移除，並清空目前設定路徑
                $("div.image").html("");
                //給予 #image_path 值，等等存檔時會用
                $("#image_path").val('');
              } else {
                //警告回傳的訊息
                alert(data);
              }

            }).fail(function(data) {
              //失敗的時候
              alert("Error occur，please check the console log");
              console.log(jqXHR.responseText);
            });
          } else {
            alert("No file can be deleted.");
          }
        });

        //表單送出
        $("#add_article_form").on("submit", function() {
          //加入loading icon
          $("div.loading").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');


            //使用 ajax 送出 帳密給 verify_user.php
            $.ajax({
              type : "POST",
              url : "php/add_photo.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
              data : {
                image_path : $("#image_path").val(), //圖片路徑
                image_css : $("input[name='img_css']:checked").val()
              },
              dataType : 'html' //設定該網頁回應的會是 html 格式
            }).done(function(data) {

              //成功的時候
              if (data == "yes") {
                //註冊新增成功，轉跳到登入頁面。
                alert("Upload Successful，profie photo will update after you login again.");
                window.location.href = "index.php";
              } else {
                alert("Updata error");
                console.log(data);
              }

            }).fail(function(jqXHR, textStatus, errorThrown) {
              //失敗的時候
              alert("Error occur，please check the console log");
              console.log(jqXHR.responseText);
            });

          return false;
        });
      });
    </script>
  </body>
</html>
