<?php
  require "head.php";
?>

<body>
  <?php

  require "header.php";
  ?>
  <h1>蔵書登録</h1>
  <form　method="post">
    <label>署名：
      <input type="text" name="name">
    </label>
    <label>署名：
      <input type="text" name="author">
    </label>
    <select>
      <option>a</option>
    </select>
    <input type="submit" value="登録する">
  </form>
</body>
