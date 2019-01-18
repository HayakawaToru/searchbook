<?php
require "function.php";
$dbCategoryData = getCategoryInfo();

// フォームでGET送信された値をソート用変数格納
$c_id = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';

$dbBooksData = getBookData($c_id);

$siteTitle = "SearchBook";
require "head.php";
?>
<body>
  <?php
    require "header.php";
  ?>
  <h1>蔵書検索</h1>
  <!-- 署名と著者で検索 -->
  <form method="post">
    <label>署名：
      <input type="text">
    </label>
    <label>著者名：
      <input type="text">
    </label>
    <input type="submit" value="検索">
  </form>
  <!-- カテゴリーフィルター -->
  <form method="get" action="">
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
  <?php
    foreach($dbBooksData as $key => $val){
      $selectedCategory = getCategoryOne($val['category_id']);
  ?>
    <div class="book-data-wrap">
      <div class="book-data-content">
        <div class="book-name">
            <?php echo $val['name'];?>
        </div>
        <div class="book-category">
            <?php echo $selectedCategory['name'];?>
        </div>
      </div>
    </div>
  <?php
    }
  ?>


</body>
</html>
