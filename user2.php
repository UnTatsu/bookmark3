<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <!-- Head[Start] -->
  <header>
    <?php if ($_SESSION["kanri_flg"] == "0") { ?>
      <?php include("menu3.php"); ?>
    <?php } else { ?>
      <?php include("menu2.php"); ?>
    <?php } ?>
    <hr>
    <div class="inhead">
      <form method="post" action="user_insert2.php" enctype="multipart/form-data">
        <div class="jumbotron4">
          <fieldset>
            <legend>ユーザー登録</legend>
            <table id="utable">
              <tr>
                <td><label>名前：</label></td>
                <td><input type="text" name="name" required></td>
              </tr>
              <tr>
                <td><label>ログインID：</label></td>
                <td><input type="text" name="lid" required></td>
              </tr>
              <tr>
                <td><label>ログインPW：</label></td>
                <td><input type="text" name="lpw" required></td>
              </tr>
              <tr>
                <td><label>ユーザー画像：</label></td>
                <td><input type="file" name="upfile"><label></label></td>
              </tr>
              <tr>
                <td><label>管理FLG：</label></td>
                <td><label>一般</label><input type="radio" name="kanri_flg" value="0"><label>　管理者</label><input type="radio" name="kanri_flg" value="1"></td>
              </tr>
            </table>

            <input type="submit" value="送信">
          </fieldset>
        </div>
      </form>
    </div>


  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->

  <!-- Main[End] -->


</body>

</html>