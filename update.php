<?php
include("funcs.php");
$pdo = db_conn();

// 1) POST取得
$id         = $_POST["id"] ?? "";
$item_name  = trim($_POST["item_name"] ?? "");
$genre      = $_POST["genre"] ?? "";
$importance = $_POST["importance"] ?? "";
$quantity   = $_POST["quantity"] ?? "";
$memo       = $_POST["memo"] ?? "";

// 2) バリデーション
if ($id === "" || !is_numeric($id)) exit("IDが不正です");
if ($item_name === "") exit("商品名が未入力です");
if (!is_numeric($quantity) || (int)$quantity < 1) exit("数量が不正です");

$id = (int)$id;
$quantity = (int)$quantity;

// 3) UPDATE
$sql = "UPDATE shopping_items
        SET item_name=:item_name, genre=:genre, importance=:importance, quantity=:quantity, memo=:memo
        WHERE id=:id";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':item_name',  $item_name,  PDO::PARAM_STR);
$stmt->bindValue(':genre',      $genre,      PDO::PARAM_STR);
$stmt->bindValue(':importance', $importance, PDO::PARAM_STR);
$stmt->bindValue(':quantity',   $quantity,   PDO::PARAM_INT);
$stmt->bindValue(':memo',       $memo,       PDO::PARAM_STR);
$stmt->bindValue(':id',         $id,         PDO::PARAM_INT);

$status = $stmt->execute();

if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}