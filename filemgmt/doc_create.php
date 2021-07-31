<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
include("../functions.php");
check_session_id();

if (
  !isset($_POST['doc_title']) || $_POST['doc_title'] == '' ||
  !isset($_POST['doc_contents']) || $_POST['doc_contents'] == '' ||
  !isset($_POST['created_by']) || $_POST['created_by'] == ''
) {
  // echo json_encode(["error_msg" => "no input"]);
  echo "<script>alert('Error:すべて入力してください．');
    setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
  exit();
}

$doc_title = $_POST['doc_title'];
$doc_contents = $_POST['doc_contents'];
$created_by = $_POST['created_by'];

$pdo = connect_to_db();

$sql = 'INSERT INTO document_table(id, doc_title, doc_contents, created_at, updated_at, created_by, updated_by) VALUES(NULL, :doc_title, :doc_contents, sysdate(), sysdate(), :created_by, :updated_by)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':doc_title', $doc_title, PDO::PARAM_STR);
$stmt->bindValue(':doc_contents', $doc_contents, PDO::PARAM_STR);
$stmt->bindValue(':created_by', $created_by, PDO::PARAM_STR);
$stmt->bindValue(':updated_by', $created_by, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:../filemgmt/doc_input.php");
  exit();
}


if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  $upload_file_name = $_FILES['upfile']['tmp_name'];
  ['upfile']['name'];
  $temp_path = $_FILES['upfile']['tmp_name'];
  $directory_path = '../files/';
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;

  if (is_uploaded_file($temp_path)) {
    if (move_uploaded_file($temp_path, $filename_to_save)) {
      chmod($filename_to_save, 0644);
      $sql = 'INSERT INTO
       todo_table(id, todo, deadline, image, created_at, updated_at)
       VALUES(NULL, :todo, :deadline, :image, sysdate(), sysdate())';
    } else {
      exit('Error:アップロードできませんでした');
    }
  } else {
    exit('Error:画像がありません');
  }
} else {
  // exit('Error:画像が送信されていません');
  $sql = 'INSERT INTO
       todo_table(id, todo, deadline, image, created_at, updated_at)
       VALUES(NULL, :todo, :deadline, NULL, sysdate(), sysdate())';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
  $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
  $status = $stmt->execute();

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    header("Location:todo_read.php");
    exit();
  }
}
