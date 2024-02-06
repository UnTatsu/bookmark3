<?php
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
?>

<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");
sschk();
?>

<html>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>好きな本ブックマーク</title>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <header>
        <?php if ($_SESSION["kanri_flg"] == "0") { ?>
            <?php include("menu3.php"); ?>
        <?php } else { ?>
            <?php include("menu2.php"); ?>
        <?php } ?>
    <hr>
        <div class="inhead">
        <form method="post" action="insert2.php">
            <div class="jumbotron2">
                <fieldset>
                    <legend>★好きな本を登録しよう★</legend>
                    <table id="ftable">
                        <tr>
                            <td><label>画像URL：</label></td>
                            <td><input type="url" name="bookimg" id="bookimg"></td>
                        </tr>
                        <tr>
                            <td><label>タイトル：</label></td>
                            <td><input type="text" name="bookname" id="bookname" required placeholder="入力必須"></td>
                        </tr>
                        <tr>
                            <td><label>著者：</label></td>
                            <td><input type="text" name="bookauthors" id="bookauthors"></td>
                        </tr>
                        <tr>
                            <td><label>商品URL：</label></td>
                            <td><input type="url" name="bookurl" id="bookurl" required placeholder="入力必須"></td>
                        </tr>
                        <tr>
                            <td><label>あらすじ：</label></td>
                            <td><textArea name="bookdescription" rows="2" cols="40" id="bookdescription"></textArea></td>
                        </tr>
                        <tr>
                            <td><label>コメント：</label></td>
                            <td><textArea name="bookcomment" rows="2" cols="40" id="bookcomment"></textArea></td>
                        </tr>
                    </table>
                    <input type="submit" value="お気に入り登録">
                </fieldset>
            </div>
        </form>       

        <!-- <div class="container-fluid2">
            <a href="select2.php">
            <div id="navbar-header2">
                <p>登録一覧</p>
            </div>
            </a> -->
        <!-- </div> -->

        </div>

    </header>

    <h2>★GoogleBooksで検索しよう★</h2>
    
        <input type="text" id="keyword" placeholder="例）頭文字D">
        <button id="readbook">書籍検索</button>
        <button id="srcclear">結果削除</button>
    <hr>
    <main>
        <table id="content">
            <tr>
                <th>選択</th>
                <th>画像</th>
                <th>タイトル</th>
                <th>著者</th>
                <th>あらすじ</th>
            </tr>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        //googlebook検索
        $("#readbook").on('click', function() {
            $("#content").find('tr').slice(1).remove() //先頭行以外削除
            // axiosを使って情報を取得する
            const sea = $("#keyword").val();
            const url = "https://www.googleapis.com/books/v1/volumes?q=" + sea
            axios.get(url).then(function(res) {
                const items = res.data.items
                // 配列の中身を一つずつ取り出してみて表示する
                items.forEach(function(item) {
                        $("#content").append(
                        '<tr><td><button class="sbtn">選択</button></td><td><img src="' 
                        + item.volumeInfo.imageLinks?.smallThumbnail + 
                        '" alt="画像なし" name="samune"></td><td><a href ="'
                        + item.volumeInfo.canonicalVolumeLink + '" name="syohin">' + item.volumeInfo.title +
                        '</a></td><td>'
                        + item.volumeInfo.authors +
                        '</td><td>'
                        + item.volumeInfo.description +
                        '</td></tr>')
                })
            })
        })

        //検索結果削除
        $("#srcclear").on('click', function(){
            $("#content").find('tr').slice(1).remove() //先頭行以外削除
        })


        //選択ボタンでフォーム反映
        $(document).on('click','.sbtn', function(){ //子要素の場合処理の順番が異なる→＄(document).on('click','id/クラス')
            let rowInfo = $(this).closest('tr'); //列を選択
            let imgurl = rowInfo.find('[name="samune"]').attr('src'); //サムネ画像のリンク取得
            let title = rowInfo.children("td").eq(2).text(); //タイトル取得
            let authour = rowInfo.children("td").eq(3).text(); //著者取得
            let burl = rowInfo.find('[name="syohin"]').attr('href'); //商品リンク取得
            let arasuzi = rowInfo.children("td").eq(4).text(); //あらすじ取得
            //formに書き換え indefined=空欄
            //サムネ画像判定
            if(imgurl === 'undefined'){
                $("#bookimg").val("");    
            }else{
                $("#bookimg").val(imgurl);
            }
            //タイトル判定
            if(title === 'undefined'){
                $("#bookname").val("");    
            }else{
                $("#bookname").val(title);
            }
            //著者判定
            if(authour === 'undefined'){
                $("#bookauthors").val("");    
            }else{
                $("#bookauthors").val(authour);
            }
            //商品リンク判定
            if(burl === 'undefined'){
                $("#bookurl").val("");    
            }else{
                $("#bookurl").val(burl);
            }
            //あらすじ判定
            if(arasuzi === 'undefined'){
                $("#bookdescription").val("");    
            }else{
                $("#bookdescription").val(arasuzi);
            }
        })


    </script>

</body>

</html>

</html>