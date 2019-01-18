<?php
// 画面処理開始
require "function.php";
$dbCategoryData = getCategoryInfo();

  $siteTitle = "CreateBook";
  require "head.php";
?>

<body>
  <?php
  require "header.php";
  ?>
  <h1>蔵書登録</h1>
  <form method="post" action="resisterBookInfo.php">
    <label>署名：
      <input type="text" name="name">
    </label>
    <label>著者名：
      <input type="text" name="author">
    </label>
    <select name="category">
      <option value=0 selected>選択して下さい</option>
      <?php
        foreach($dbCategoryData as $key => $val){
      ?>
        <option value="<?php echo $val['id'];?>">
          <?php echo $val['name'];?>
        </option>
      <?php
        }
      ?>
    </select>
    <input type="submit" value="登録する">
  </form>
</body>
