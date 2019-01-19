<?php
ini_set('log_errors','on');
ini_set('error_log','php.log');

//================================
// デバッグ
//================================
//デバッグフラグ
$debug_flg = true;
//デバッグログ関数
function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('デバッグ：'.$str);
  }
}

// エラーメッセージ用配列-----------------------------------
$err = '';

function validRequired($postStr){
    if(empty($postStr)){
    global $err;
    $err = '入力必須';
  }
}

//sessionを１回だけ取得できる
function getSessionData(){
  if(!empty($_SESSION)){
    $resultArr = array("result" => $_SESSION['result'],
    "result_flg" => $_SESSION['result_flg']
    );
    $_SESSION = '';
    return $resultArr;
  }else{
    return false;
  }
}

// カテゴリー情報の取得
function getCategoryInfo(){
  try{
    $dbh = dbConnect();
    $sql = 'SELECT * FROM categories';
    $data = array();
    $stmt = queryPost($dbh, $sql, $data);
    if($stmt) {
      return $stmt->fetchAll();
    }else{
      return false;
    }
  }catch (Exception $e){

  }
}

function getBookData($c_id){
  try{
    $dbh = dbConnect();
    if(empty($c_id)){
      $sql = 'SELECT * FROM books';
      $data = array();
    }else{
      $sql = 'SELECT * FROM books WHERE category_id = :c_id';
      $data = array(":c_id" => $c_id);
    }
    $stmt = queryPost($dbh, $sql, $data);
    if($stmt) {
      return $stmt->fetchAll();
    }else{
      return false;
    }
  }catch (Exception $e){
  }
}

function getCategoryOne($category_id){
  try{
    $dbh = dbConnect();
    $sql = 'SELECT name FROM categories WHERE id = :id';
    $data = array(":id" => $category_id);
    $stmt = queryPost($dbh, $sql, $data);
    if($stmt) {
      return $stmt->fetch();
    }else{
      return false;
    }
  }catch (Exception $e){
  }
}

// DB関連------------------------------------------------

function dbConnect(){
    $dsn = 'mysql:dbname=search_book;host=localhost:8889;charset=utf8';
    $user = 'root';
    $password ='root';
    $options = array(
      // SQL実行失敗時にはエラーコードのみ設定
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
      // デフォルトフェッチモードを連想配列形式に設定
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
      // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    );
    $dbh = new PDO($dsn, $user, $password, $options);

    return $dbh;
}

function queryPost($dbh, $sql, $data){
  // クエリー作成
  $stmt = $dbh->prepare($sql);
  // プレースホルダーに値をセットし、SQL文を実行
  if(!$stmt->execute($data)){
    return 0;
  }else{
    return $stmt;
  }
}


?>
