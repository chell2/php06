<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
include("../functions.php");
check_session_id();

if (
  !isset($_POST['doc_title']) || $_POST['doc_title'] == '' ||
  !isset($_POST['doc_contents']) || $_POST['doc_contents'] == '' ||
  !isset($_POST['updated_by']) || $_POST['updated_by'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$doc_title = $_POST["doc_title"];
$doc_contents = $_POST["doc_contents"];
$updated_by = $_POST["updated_by"];
$id = $_POST["id"];

$pdo = connect_to_db();

$sql = "UPDATE document_table SET doc_title=:doc_title, doc_contents=:doc_contents, updated_at=sysdate(), updated_by=:updated_by WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':doc_title', $doc_title, PDO::PARAM_STR);
$stmt->bindValue(':doc_contents', $doc_contents, PDO::PARAM_STR);
$stmt->bindValue(':updated_by', $updated_by, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // echo "<script>alert('更新しました．');
  // setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
  header("Location:../filemgmt/doc_read.php");
  exit();
}
