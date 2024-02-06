<?php
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
?>

<?php
//0. SESSION開始！！
session_start();

//１．PHP
$id = $_GET["id"];

include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();
$pdo = db_conn();      //DB接続関数

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id"); //SQLをセット
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view = ""; //HTML文字列作り、入れる変数
if ($status == false) {
    //SQLエラーの場合
    sql_error($stmt);
} else {
    //SQL成功の場合
    $row = $stmt->fetch();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容の変更</title>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <header>
        <?php if ($_SESSION["kanri_flg"] == "0") { ?>
            <?php include("menu3.php"); ?>
        <?php } else { ?>
            <?php include("menu2.php"); ?>
        <?php } ?>
        <div class="inhead">
            <form method="post" action="update2.php">
                <div class="jumbotron3">
                    <fieldset>
                        <legend>★登録内容を変更しよう★</legend>
                        <table id="dtable">
                            <tr>
                                <td><label>画像URL：</label></td>
                                <td><input type="text" name="bookimg" id="dbookimg" value="<?= $row["bookimg"] ?>"></td>
                                <td rowspan="6"><a href="<?= $row["bookurl"] ?>" target="_blank" id="d2a"><img src="<?= $row["bookimg"] ?>" alt="画像なし" id="d2img"></a></td>
                            </tr>
                            <tr>
                                <td><label>タイトル：</label></td>
                                <td><input type="text" name="bookname" required placeholder="入力必須" value="<?= $row["bookname"] ?>"></td>
                            </tr>
                            <tr>
                                <td><label>著者：</label></td>
                                <td><input type="text" name="bookauthors" value="<?= $row["bookauthors"] ?>"></td>
                            </tr>
                            <tr>
                                <td><label>商品URL：</label></td>
                                <td><input type="text" name="bookurl" id="dbookurl" required placeholder="入力必須" value="<?= $row["bookurl"] ?>"></td>
                            </tr>
                            <tr>
                                <td><label>あらすじ：</label></td>
                                <td><textArea name="bookdescription" rows="2" cols="40"><?= $row["bookdescription"] ?></textArea></td>
                            </tr>
                            <tr>
                                <td><label>コメント：</label></td>
                                <td><textArea name="bookcomment" rows="2" cols="40"><?= $row["bookcomment"] ?></textArea></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="submit" value="変更" id="dt2subbtn">
                        <hr>
                        <div class="d2textbox">
                            <span class="d2text">※ 画像をクリックすると商品ページに飛べます！</span>
                            <br>
                            <span class="d2text">※ 画像URL/商品URLを変更すると画像/商品ページも変化します！</span>
                        </div>
                    </fieldset>
                </div>
            </form>


        </div>

    </header>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //画像URLが変更したら画像変化
        function imgChange(event) {
            let i = $("#dbookimg").val()
            $("#d2img").attr("src", i);
        }
        //商品URLが変更したらリンク変化
        function urlChange(event) {
            let u = $("#dbookurl").val()
            $("#d2a").attr("href", u);
        }
        //画像URLの参照
        const imgelement = document.querySelector('#dbookimg')
        const urlelement = document.querySelector('#dbookurl')
        //画像URLの変更を監視→変更したらその画像に表示変更
        imgelement.addEventListener('input', imgChange);
        urlelement.addEventListener('input', urlChange);
    </script>

</body>

</html>