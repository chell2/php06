<?php
session_start();
include("../functions.php");
check_session_id();

$pdo = connect_to_db();
$user_id = $_SESSION["id"];
// $sql = "SELECT * FROM document_table";
$sql = "SELECT * FROM document_table
        LEFT OUTER JOIN (SELECT doc_id, COUNT(id) AS cnt
        FROM approval_table GROUP BY doc_id) AS appr
        ON document_table.id = appr.doc_id";
// ASは置き換え

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// $users = "SELECT * FROM approval_table LEFT OUTER JOIN users_table ON approval_table.user_id = users_table.id";
// // で文書（doc_id）の承認者（username）の値はとれるけれど、どう表示すればよいかわからない
// $stmt_users = $pdo->prepare($users);
// $status_users = $stmt_users->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    if ($user_id == $record["created_by"]) {
      $output .= "<tr>";
      $output .= "<td class='title'>{$record["doc_title"]}</td>";
      $output .= "<td>{$record["doc_contents"]}</td>";
      $output .= "<td><a href='../filemgmt/cleate_file.php?id={$record["id"]}' class='icon'><i class='fas fa-file-upload'></i></a></td>";
      $output .= "<td><div class='tooltip'>
      <span class='tooltip-text'>承認者を表示</span>
      <span><i class='fas fa-thumbs-up'></i> :{$record["cnt"]}</span></div></td>";
      $output .= "<td><a href='../filemgmt/doc_edit.php?id={$record["id"]}' class='icon'><i class='fas fa-pencil-alt'></i></a></td>";
      $output .= "<td><a href='../filemgmt/doc_delete.php?id={$record["id"]}' class='icon' onclick='return confirm_del();'><i class='fas fa-eraser'></i></a></td>";
      $output .= "</tr>";
    } else {
      $output .= "<tr>";
      $output .= "<td class='title'>{$record["doc_title"]}</td>";
      $output .= "<td>{$record["doc_contents"]}</td>";
      $output .= "<td><a href='../filemgmt/cleate_file.php?id={$record["id"]}' class='icon'><i class='fas fa-file-upload'></i></a></td>";
      // $output .= "<td><a href='approval_create.php?user_id={$user_id}&doc_id={$record["id"]}'>承認</a></td>"; 
      $output .= "<td><div class='tooltip'>
      <span class='tooltip-text'>承認者を表示</span>
      <a href='../filemgmt/approval_create.php?user_id={$user_id}&doc_id={$record["id"]}' class='icon'><i class='far fa-thumbs-up'></i></a>
      <span> :{$record["cnt"]}</span>
      </div></td>";
      $output .= "<td><a href='../filemgmt/doc_edit.php?id={$record["id"]}' class='icon'><i class='fas fa-pencil-alt'></i></a></td>";
      $output .= "<td></td></tr>";
    }
  }
  unset($value);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>文書一覧</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/filemgmt.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <style>
    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    ::-webkit-scrollbar-track {
      box-shadow: 0 0 5px #a6a5c4 inset;
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background: #4e54c8;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <script>
    function confirm_del() {
      var select = confirm("本当に削除しますか？ \n「OK」で削除 \n「キャンセル」で中止");
      return select;
    }
  </script>
  <div class="wrap">
    <div class="sideNav">
      &emsp;<br>文<br>書<br>一<br>覧<br>
    </div>
    <div class="content">
      <fieldset>
        <p hidden><?= $user_id ?>:<?= $_SESSION["position"] ?>:<?= $_SESSION["username"] ?></p>
        <!-- <legend>文書一覧</legend> -->
        <div>
          <a href="../filemgmt/doc_input.php" class="link">文書登録</a> / <a href="../login/logout.php" class="link">ログアウト</a>
        </div>
        <div>
          <table>
            <thead>
              <tr>
                <th>件名</th>
                <th>区分</th>
                <th>添付</th>
                <th>承認</th>
                <th>編集</th>
                <th>削除</th>
              </tr>
            </thead>
            <tbody>
              <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
              <?= $output ?>
            </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>
</body>

</html>