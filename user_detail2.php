<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$id = filter_input(INPUT_GET, "id");

//1. DB接続
$pdo = db_conn();

//2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//3.データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
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
            <form method="post" action="user_update2.php">
                <div class="jumbotron4">
                    <fieldset>
                        <legend>ユーザー更新</legend>
                        <table id="udtable">
                            <tr>
                                <td><label>名前：</label></td>
                                <td><input type="text" name="name" value="<?php echo $row["name"]; ?>"></td>
                            </tr>
                            <tr>
                                <td><label>ログインID：</label></td>
                                <td><input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></td>
                            </tr>
                            <tr>
                                <td><label>ログインPW：</label></td>
                                <td><input type="text" name="lpw" placeholder="変更あるときだけ入力"></td>
                            </tr>
                            <tr>
                                <td><label>管理フラグ：</label></td>
                                <td>
                                    <?php if ($row["kanri_flg"] == "0") { ?>
                                        <label>一般</label><input type="radio" name="kanri_flg" value="0" checked="checked">　
                                        <label>管理者</label><input type="radio" name="kanri_flg" value="1">
                                    <?php } else { ?>
                                        <label>一般</label><input type="radio" name="kanri_flg" value="0">　
                                        <label>管理者</label><input type="radio" name="kanri_flg" value="1" checked="checked">
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>退会フラグ：</label></td>
                                <td>
                                    <?php if ($row["life_flg"] == "0") { ?>
                                        <label>利用中</label><input type="radio" name="life_flg" value="0" checked="checked">　
                                        <label>退会</label><input type="radio" name="life_flg" value="1">
                                    <?php } else { ?>
                                        <label>利用中</label><input type="radio" name="life_flg" value="0">　
                                        <label>退会</label><input type="radio" name="life_flg" value="1" checked="checked">
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="更新">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
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