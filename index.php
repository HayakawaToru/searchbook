<?php
$siteTitle = SearchBook;
require "head.php";
?>
<body>
  <?php
    require "header.php";
  ?>
  <h1>蔵書検索</h1>
  <!-- 署名と著者で検索 -->
  <form>
    <label>署名：
      <input type="text">
    </label>
    <label>著者名：
      <input type="text">
    </label>
    <input type="submit" value="検索">
  </form>
  <!-- カテゴリーフィルター -->
  <form method="post">
    <select>
      <option>
    </select>
  </form>

</body>
</html>
