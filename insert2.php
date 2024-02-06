<?php
//0. SESSION開始！！
session_start();

//1. POSTデータ取得
$bookimg = $_POST['bookimg'];
$bookname = $_POST['bookname'];
$bookauthors = $_POST['bookauthors'];
$bookurl = $_POST['bookurl'];
$bookdescription = $_POST['bookdescription'];
$bookcomment = $_POST['bookcomment'];

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table ( bookimg, bookname, bookauthors, bookurl, bookdescription, bookcomment, indate ) VALUES( :bookimg, :bookname, :bookauthors, :bookurl, :bookdescription, :bookcomment, sysdate())");
$stmt->bindValue(':bookimg', $bookimg, PDO::PARAM_STR); 
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR); 
$stmt->bindValue(':bookauthors', $bookauthors, PDO::PARAM_STR); 
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  
$stmt->bindValue(':bookdescription', $bookdescription, PDO::PARAM_STR);  
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index2.phpへリダイレクト
  redirect("index2.php");
}
?>