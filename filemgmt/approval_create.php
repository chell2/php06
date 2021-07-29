<?php
// var_dump($_GET);
// exit();

session_start();
include("../functions.php");
check_session_id();

$user_id = $_GET["user_id"];
$doc_id = $_GET["doc_id"];

$pdo = connect_to_db();

// $sql = "INSERT INTO approval_table(id, user_id, doc_id, created_at)VALUES(NULL, :user_id, :doc_id, sysdate())";
$sql = "SELECT COUNT(*) FROM approval_table WHERE user_id=:user_id AND doc_id=:doc_id";  // (*)ですべてのレコードをカウント(NULL含む)

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
$stmt->bindValue(":doc_id", $doc_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	// header('Location:doc_read.php');
	$approval_count = $stmt->fetch();
}

if ($approval_count[0] != 0) {
	$sql = "DELETE FROM approval_table WHERE user_id=:user_id AND doc_id=:doc_id";
} else {
	$sql = "INSERT INTO approval_table(id, user_id, doc_id, created_at)VALUES(NULL, :user_id, :doc_id, sysdate())";
}
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
$stmt->bindValue(":doc_id", $doc_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header("Location:../filemgmt/doc_read.php");
	exit();
}
// var_dump("imakoko");
// exit();
