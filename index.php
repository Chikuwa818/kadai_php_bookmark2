<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>買い物リスト登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding:10px;font-size:16px;}</style>
</head>
<body>
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="select.php">一覧へ</a></div>
    </div>
  </nav>
</header>

<form method="POST" action="insert.php">
  <div class="jumbotron">
    <fieldset>
      <!-- タイトル -->
      <legend>買い物リスト登録</legend>
      
      <!-- テキスト自由入力 -->
      <label>商品名：
        <input type="text" name="item_name" required>
      <!-- 必須項目にしたいから requiredをつける ブラウザ依存の機能らしい-->
      </label><br><br>

      <!-- セレクトボックス -->
      <label>ジャンル：
        <select name="genre">
          <option value="食品">食品</option>
          <option value="日用品">日用品</option>
          <option value="衣料">衣料</option>
          <option value="その他">その他</option>
        </select>
      </label><br><br>

      <!-- ラジオボタン セレクトボックスと違ってデフォルト値が設定されないので、checkedをどれかにつける-->
      <label>重要度：</label>
      <label><input type="radio" name="importance" value="高" checked> 高</label>
      <label><input type="radio" name="importance" value="中"> 中</label>
      <label><input type="radio" name="importance" value="低"> 低</label>
      <br><br>

      <!-- INTデータ -->
      <label>数量：
        <input type="number" name="quantity" min="1" value="1" required>
      </label><br><br>
      <!-- 必須項目にしたいから requiredをつける -->
       
      <!-- テキスト　大きめ　空欄でもOK -->
      <label>メモ：<br>
        <textarea name="memo" rows="3" cols="40"></textarea>
      </label><br><br>

      <input type="submit" value="登録" class="btn btn-primary">
    </fieldset>
  </div>
</form>

<hr>
<a href="select.php">登録内容を確認する</a>
</body>
</html>