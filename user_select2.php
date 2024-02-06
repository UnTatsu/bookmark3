<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<td><a href="user_detail2.php?id=' . h($result["id"]) . '"><button class="ddbtn">' . '更新' . '</button>';
        $view .= '<a href="user_delete2.php?id=' . h($result["id"]) . '"><button class="ddbtn">' . '削除' . '</button></td>';
        $view .= '<td><img src="upload/' . $result["img"] . '"></td>';
        $view .= '<td>' . $result["name"] . '</td>';
        $view .= '<td>' . $result["lid"] . '</td>';
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
    <title>ユーザー一覧</title>
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
    <div class="user-s2">
        <table id="usertable">
            <tr>
                <th>更新/削除</th>
                <th>ユーザー画像</th>
                <th>名前</th>
                <th>ログインID</th>
            </tr>
            <?= $view ?>
        </table>
    </div>
    <!-- Main[End] -->

</body>

</html>