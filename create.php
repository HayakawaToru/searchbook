<?php
// 画面処理開始
require "function.php";
$dbCategoryData = getCategoryInfo();

  $siteTitle = "CreateBook";
  require "head.php";
?>

<body class="1column createPage">
  <?php
  require "header.php";
  ?>
  <div id="main" class="create-page">
    <div class="content">
      <h1 class="page-title">蔵書登録</h1>
      <form method="post" action="resisterBookInfo.php">
        <label>書名：
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
    </div>
  </div>
</body>
