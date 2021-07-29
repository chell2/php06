<?php
// var_dump($_GET);
// exit();

session_start();
// 関数ファイル読み込み処理
include("functions.php");
check_session_id();
// DB接続の処理を記述
$pdo = connect_to_db();

$search_word = $_GET["searchword"]; // GETのデータ受け取り
$sql = "SELECT * FROM document_table WHERE doc_title LIKE :search_word";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result); // JSON形式にして出力
	exit();
}
