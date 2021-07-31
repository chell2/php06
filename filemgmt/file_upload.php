<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
// var_dump($_FILES);
// exit();
session_start();
include("../functions.php");
check_session_id();
$user_id = $_SESSION["id"];

$pdo = connect_to_db();
$doc_id = $_POST['doc_id'];
$uploaded_by = $_POST['uploaded_by'];

// キャプションを取得（サニタイズ）
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

// キャプションのバリデーション
// 140文字か
if (strlen($caption) > 140) {
  echo "<script>alert('Error:キャプションは140文字以内で入力してください．');
  setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
  exit();
}

// ファイルのバリデーション
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  $uploaded_file_name = $_FILES['upfile']['name'];
  $temp_path = $_FILES['upfile']['tmp_name'];
  $directory_path = '../files/';
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;

  if (is_uploaded_file($temp_path)) {
    if (move_uploaded_file($temp_path, $filename_to_save)) {
      chmod($filename_to_save, 0644);

      $sql = 'INSERT INTO
       file_table(id, doc_id, file_name, file_path, caption, uploaded_at, uploaded_by)
       VALUES(NULL, :doc_id, :file_name, :file_path, :caption, sysdate(), :uploaded_by)';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':doc_id', $doc_id, PDO::PARAM_STR);
      $stmt->bindValue(':file_name', $uploaded_file_name, PDO::PARAM_STR);
      $stmt->bindValue(':file_path', $filename_to_save, PDO::PARAM_STR);
      $stmt->bindValue(':caption', $caption, PDO::PARAM_STR);
      $stmt->bindValue(':uploaded_by', $uploaded_by, PDO::PARAM_STR);
      $status = $stmt->execute();

      if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
      } else {
        header("Location:../filemgmt/doc_read.php");
        exit();
      }
    } else {
      echo "<script>alert('Error:アップロードできませんでした．');
      setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
      exit();
    }
  } else {
    echo "<script>alert('Error:ファイルがありません．');
    setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
    exit();
  }
} else {
  echo "<script>alert('Error:ファイルが送信されていません．');
  setTimeout(function(){window.location.href = '../filemgmt/doc_read.php';}, 1)</script>";
  exit();
}
