<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
include("../functions.php");

$pdo = connect_to_db();

$username = $_POST["username"];
$password = $_POST["password"];


$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$val) {
  echo "<script>alert('ログイン情報に誤りがあります．');
  setTimeout(function(){window.location.href = '../login/login.php';}, 1)</script>";
  // echo '<a href="../login/login.php">login</a>';
  exit();
} else {
  $_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["username"] = $val["username"];
  $_SESSION["position"] = $val["position"];
  $_SESSION["id"] = $val["id"];

  header("Location:../filemgmt/doc_read.php");
  exit();
}
