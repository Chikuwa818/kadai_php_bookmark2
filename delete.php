<?php
$id = $_GET["id"] ?? "";
if ($id === "" || !is_numeric($id)) {
  exit("IDが不正です");
}
$id = (int)$id;

include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("DELETE FROM shopping_items WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}