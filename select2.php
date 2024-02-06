<?php
//0. SESSION開始！！
session_start();

//1.  DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<tr>';
    $view .= '<td><a href="detail2.php?id=' . h($res["id"]) . '"><button class="ddbtn">' . '更新' . '</button>';
    $view .= '<a href="delete2.php?id=' . h($res["id"]) . '"><button class="ddbtn">' . '削除' . '</button></td>';
    $view .= '<td><a href="' . h($res['bookurl']) . '" target="_blank"><img src="' . h($res['bookimg']) . '" alt="画像なし"></a></td>';
    $view .= '<td><a href="' . h($res['bookurl']) . '" target="_blank">' . h($res['bookname']) . '</a></td>';
    $view .= '<td>' . h($res['bookauthors']) . '</td>';
    $view .= '<td>' . h($res['bookdescription']) . '</td>';
    $view .= '<td>' . h($res['bookcomment']) . '</td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>お気に入りの本</title>

  <link rel="stylesheet" href="./css/style.css">
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
    <?php if ($_SESSION["kanri_flg"] == "0") { ?>
      <?php include("menu3.php"); ?>
    <?php } else { ?>
      <?php include("menu2.php"); ?>
    <?php } ?>


  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <div class="hs2text">※ 画像 or タイトル をクリックで商品ページに飛べます！</div>
  <div>
    <table id="favorite">
      <tr>
        <th>更新<br>削除</th>
        <th>画像</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>あらすじ</th>
        <th>コメント</th>
      </tr>
      <?= $view ?>
    </table>
  </div>
  <!-- Main[End] -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script>
    //登録画面はこちら
    $("#in2back").on('click', function() {
      window.open('index2.php')
      open('about:blank', '_self').close(); //一度再表示してからClose
    })
  </script>

</body>

</html>