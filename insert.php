<?php
// funcs.php読み込み、DB接続
include("funcs.php");
$pdo = db_conn();

// POST取得
// trim 文字列の先頭および末尾にある空白入力を取り除く　https://www.php.net/manual/ja/function.trim.php
// ** ?? "" →　左がなかったら右の値を入れる、index.php側の構造的はないけど
$item_name  = trim($_POST["item_name"] ?? "");
$genre      = $_POST["genre"] ?? "";
$importance = $_POST["importance"] ?? "";
$quantity   = $_POST["quantity"] ?? "";
$memo       = $_POST["memo"] ?? "";

// 2) 最低限のバリデーション
if ($item_name === "") {
    exit("商品名が未入力です。");
}
// is_numeric 変数が数字または数値形式の文字列か調べる　https://www.php.net/manual/ja/function.is-numeric.php　これも原則おこらないはず
// ほんで１以上の値が入っているかもチェックする
if (!is_numeric($quantity) || (int)$quantity < 1) {
    exit("数量が不正です。");
}

// INSERT SQL分を変数に入れて使う
$sql = "INSERT INTO shopping_items (item_name, genre, importance, quantity, memo)
        VALUES (:item_name, :genre, :importance, :quantity, :memo)";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':item_name',  $item_name,  PDO::PARAM_STR);
$stmt->bindValue(':genre',      $genre,      PDO::PARAM_STR);
$stmt->bindValue(':importance', $importance, PDO::PARAM_STR);
$stmt->bindValue(':quantity',   $quantity,   PDO::PARAM_INT);
$stmt->bindValue(':memo',       $memo,       PDO::PARAM_STR);

$status = $stmt->execute();

// 失敗したらエラー、成功したら登録リストへ
if ($status === false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}