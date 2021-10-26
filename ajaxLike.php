<?php
//共通変数・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug(' Ajax ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// Ajax処理
//================================
//POSTがあり、ユーザーIDがあり、ログインしている場合
if(isset($_POST['recipe_id']) && isset($_SESSION['user_id']) && isLogin()){
  debug('POST送信があります。');
  $r_id = $_POST['recipe_id'];
  debug('レシピID：'.$r_id);
  //例外処理
  try {
    //DBへ接続
    $dbh = dbConnect();
    //レコードがあるか検索
    $sql = 'SELECT * FROM `like` WHERE recipes_id = :r_id AND user_id = :u_id';
    $data = array(':r_id' => $r_id, ':u_id' => $_SESSION['user_id']);
    //クエリ実行
    $stmt = queryPost($dbh, $sql, $data);
    $resultCount = $stmt->rowCount();
    debug($resultCount);
    //レコードが１件でもある場合
    if(!empty($resultCount)){
      //　レコードを削除する
      $sql = 'DELETE FROM `like` WHERE recipes_id = :r_id AND user_id = :u_id';
      $data = array(':r_id' => $r_id, ':u_id' => $_SESSION['user_id']);
      //クエリ実行
      $stmt = queryPost($dbh, $sql, $data);
    }else{
      //レコードを挿入する
      $sql = 'INSERT INTO `like` (recipes_id, user_id, create_date) VALUES (:r_id, :u_id, :date)';
      $data = array(':r_id' => $r_id, ':u_id' => $_SESSION['user_id'], ':date' => date('Y-m-d H:i:s'));
      //クエリ実行
      $stmt = queryPost($dbh, $sql, $data);
    }
  } catch (Exception $e){
    error_log('エラー発生：'.$e->getMessage());
  }
}
debug('Ajax処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>