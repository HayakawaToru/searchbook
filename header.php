<header>
  <div>
    Test Library
  </div>
  <ul>
    <!-- ページによってヘッダーの内容を変更するpage_flg -->
    <?php $page_flg = (!empty($_GET['page_flg'])) ? $_GET['page_flg'] : 0;

      if($page_flg==0){
      echo '<li><a href="create.php?page_flg=1">蔵書登録</a></li>';
        }else if($page_flg ==1){
      echo '<li><a href="index.php?page_flg=0">蔵書検索</a></li>';
    } ?>
  </ul>
</header>
