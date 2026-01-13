<?php
include("funcs.php");
$pdo = db_conn();

// 1) POST取得（未入力でも落ちないように）
$item_name  = trim($_POST["item_name"] ?? "");
$genre      = $_POST["genre"] ?? "";
$importance = $_POST["importance"] ?? "";
$quantity   = $_POST["quantity"] ?? "";
$memo       = $_POST["memo"] ?? "";

// 2) 最低限のバリデーション
if ($item_name === "") {
    exit("商品名が未入力です。");
}
if (!is_numeric($quantity) || (int)$quantity < 1) {
    exit("数量が不正です。");
}
$quantity = (int)$quantity;

// 3) INSERT（日時カラムはテーブル定義に依存するので、ここでは入れない）
$sql = "INSERT INTO shopping_items (item_name, genre, importance, quantity, memo)
        VALUES (:item_name, :genre, :importance, :quantity, :memo)";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':item_name',  $item_name,  PDO::PARAM_STR);
$stmt->bindValue(':genre',      $genre,      PDO::PARAM_STR);
$stmt->bindValue(':importance', $importance, PDO::PARAM_STR);
$stmt->bindValue(':quantity',   $quantity,   PDO::PARAM_INT);
$stmt->bindValue(':memo',       $memo,       PDO::PARAM_STR);

$status = $stmt->execute();

// 4) 成功/失敗
if ($status === false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}