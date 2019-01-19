<?php
require "function.php";
session_start();
if($_GET['off_flg'] == 1){
  $_SESSION = '';
}
$dbCategoryData = getCategoryInfo();

// フォームでGET送信された値をソート用変数格納
$c_id = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';
if(!empty($c_id)){
  $_SESSION = '';
}
$dbBooksData = getBookData($c_id);
// var_dump($dbBooksData);
$siteTitle = "SearchBook";
require "head.php";
?>

<body class="1column">
  <?php
    require "header.php";
  ?>
  <div id="main">
    <div class="content">
      <h1 class="page-title">蔵書検索</h1>
      <!-- 署名と著者で検索 -->
      <form method="post" class="search" action="search.php">
        <label>探したい本の情報を入力
          <input type="text" name="book-info">
        </label>
        <input type="submit" value="検索">
      </form>
      <!-- カテゴリーフィルター -->
      <form method="get" action="" class="filter">
        <select name="c_id">
          <option value=0 selected>選択してください</option>
          <?php
            foreach ($dbCategoryData as $key => $val){
          ?>
            <option value="<?php echo $val['id'];?>">
              <?php echo $val['name'];?>
            </option>
          <?php
            }
          ?>
        </select>
        <input type="submit" value="ジャンルで絞り込み">
      </form>

      <!-- 蔵書一覧の表示 -->
      <div class="index-area">
      <?php
      $result = getSessionData();
      if($result == false){
        if(!empty($c_id)){
          echo "<div><a href='index.php?off_flg=1'>全件表示に戻る</a></div>";
        }
        foreach($dbBooksData as $key => $val){
          $selectedCategory = getCategoryOne($val['category_id']);
      ?>
        <div class="book-data-wrap">
          <div class="book-data-content">
            <div class="book-name">
                <?php echo "書名：".$val['name'];?>
            </div>
            <div class="book-category">
                <?php echo "ジャンル：".$selectedCategory['name'];?>
            </div>
          </div>
        </div>
      <?php
        }
        ?>
    <?php
      }else{
        echo "<div><a href='index.php?off_flg=1'>全件表示に戻る</a></div>";
        foreach($result['result'] as $key => $val){
          $selectedCategory = getCategoryOne($val['category_id']);
        ?>
        <div class="book-data-wrap">
          <div class="book-data-content">
            <div class="book-name">
                <?php echo "書名：".$val['name'];?>
            </div>
            <div class="book-category">
                <?php echo "ジャンル：".$selectedCategory['name'];?>
            </div>
          </div>
        </div>
      <?php
      }
    }
      ?>
    </div>
    </div>
  </div>

</body>
</html>
