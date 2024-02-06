<?php
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
?>

<?php
//1. POSTデータ取得
$bookimg = $_POST['bookimg'];
$bookname = $_POST['bookname'];
$bookauthors = $_POST['bookauthors'];
$bookurl = $_POST['bookurl'];
$bookdescription = $_POST['bookdescription'];
$bookcomment = $_POST['bookcomment'];
$id = $_POST["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE gs_bm_table SET bookimg=:bookimg, bookname=:bookname, bookauthors=:bookauthors, bookurl=:bookurl, bookdescription=:bookdescription, bookcomment=:bookcomment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookimg', $bookimg, PDO::PARAM_STR); 
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR); 
$stmt->bindValue(':bookauthors', $bookauthors, PDO::PARAM_STR); 
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  
$stmt->bindValue(':bookdescription', $bookdescription, PDO::PARAM_STR);  
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);  
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．select2.phpへリダイレクト
  redirect("select2.php");
}
?>