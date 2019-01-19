<?php
  require "function.php";
  debug('蔵書登録処理スタート---------------------');

  if(!empty($_POST)){
    debug('POST情報:'.print_r($_POST,true));
    $name = $_POST['name'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    validRequired($name);
    validRequired($author);
    validRequired($category);

    if(empty($err)){
      try{
        $dbh = dbConnect();
        $sql = 'INSERT INTO books(name, author, category_id, created_at, updated_at) VALUES (:name, :author, :category_id, :created_at, :updated_at)';
        $data = array(":name" => $name, ":author" => $author, ":category_id" => $category,
          ":created_at" => date('Y-m-d H:i:s'),
          ":updated_at" => date('Y-m-d H:i:s')
        );
        $stmt = queryPost($dbh, $sql, $data);
        if($stmt){
          header("Location:index.php?page_flg=0");
        }else{
          header("Location:create.php?page_flg=1");
        }
      }catch(Exception $e){
        error_log('エラー発生:'. $e->getMessage());
      }
    }

  }else{
    header("Location:create.php?page_flg=1");
  }

?>
