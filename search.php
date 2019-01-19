<?php
  require "function.php";
  session_start();
  if(!empty($_POST)){
    $book_info = $_POST['book-info'];
    validRequired($book_info);
    debug('POST情報：'.print_r($_POST,true));

    if(empty($err)){
      debug('err情報：'.print_r($err,true));
      $dbh = dbConnect();
      $sql = 'SELECT * FROM books WHERE name LIKE (:info)';
      $data = array(":info" => $book_info);

      $stmt = queryPost($dbh, $sql, $data);
      debug('stmt情報：'.print_r($stmt,true));

      if($stmt){
        $_SESSION['result'] = $stmt->fetchAll();
        debug('result情報：'.print_r($_SESSION['result'],true));
        $_SESSION['result_flg'] = 1;
        header("Location:index.php?page_flg=0");
      }else{
        return false;
      }
    }
  }else{
    header("Location:index.php?page_flg=0");
  }
?>
