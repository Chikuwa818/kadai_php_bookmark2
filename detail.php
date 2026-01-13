<?php
include("funcs.php");
$pdo = db_conn();

// 1) id取得
$id = $_GET["id"] ?? "";
if ($id === "" || !is_numeric($id)) {
  exit("IDが不正です");
}
$id = (int)$id;

// 2) 1件取得
$sql = "SELECT * FROM shopping_items WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  sql_error($stmt);
}

$v = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$v){
  exit("データが見つかりません");
}

// 3) 画面用
$genres = ["食品","日用品","衣料","その他"];
$imps = ["高","中","低"];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding:10px;font-size:16px;}</style>
</head>
<body>
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">一覧へ</a>
      </div>
    </div>
  </nav>
</header>

<form method="POST" action="update.php">
  <div class="jumbotron">
    <fieldset>
      <legend>買い物リスト 更新</legend>

      <label>ID：<?= h($v["id"]) ?></label><br><br>

      <label>商品名：
        <input type="text" name="item_name" value="<?= h($v["item_name"]) ?>" required>
      </label><br><br>

      <label>ジャンル：
        <select name="genre">
          <?php foreach($genres as $g): ?>
            <option value="<?= h($g) ?>" <?= ($v["genre"]===$g) ? "selected" : "" ?>>
              <?= h($g) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label><br><br>

      <label>重要度：</label>
      <?php foreach($imps as $imp): ?>
        <label>
          <input type="radio" name="importance" value="<?= h($imp) ?>"
            <?= ($v["importance"]===$imp) ? "checked" : "" ?>>
          <?= h($imp) ?>
        </label>
      <?php endforeach; ?>
      <br><br>

      <label>数量：
        <input type="number" name="quantity" min="1" value="<?= h($v["quantity"]) ?>" required>
      </label><br><br>

      <label>メモ：<br>
        <textarea name="memo" rows="3" cols="40"><?= h($v["memo"]) ?></textarea>
      </label><br><br>

      <!-- 重要：更新対象のID -->
      <input type="hidden" name="id" value="<?= h($v["id"]) ?>">

      <input type="submit" value="更新する" class="btn btn-primary">
      <a class="btn btn-default" href="select.php">戻る</a>
    </fieldset>
  </div>
</form>
</body>
</html>


