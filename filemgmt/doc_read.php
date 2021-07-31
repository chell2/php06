<?php
session_start();
include("../functions.php");
check_session_id();

$pdo = connect_to_db();
$user_id = $_SESSION["id"];

//// 文書（doc_id）ごとの承認数をカウント ////
$sql = "SELECT * FROM document_table
        LEFT OUTER JOIN (SELECT doc_id, COUNT(id) AS cnt
        FROM approval_table GROUP BY doc_id) AS cnt_group
        ON document_table.id = cnt_group.doc_id";
// ASは置き換え
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//SELECT * 全データ
//FROM document_table 文書テーブルと
//LEFT OUTER JOIN 文書ごとの承認数を結合
//(SELECT doc_id, COUNT(id) AS cnt
//FROM approval_table GROUP BY doc_id) AS gro
//ON document_table.id = gro.doc_id
//文書テーブルidと承認数の文書idを一致

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {

    /////////////////////////////////////////

    // 文書（doc_id）の承認者（approver）を表示 //
    $sql_appr = "SELECT doc_id,
    GROUP_CONCAT(CONCAT(username) SEPARATOR ', ') AS approver 
    FROM (approval_table LEFT OUTER JOIN users_table 
    ON approval_table.user_id = users_table.id) GROUP BY doc_id";

    //GROUP BY doc_id doc_idごとに
    //usernameをまとめる
    //FROM approval_table 承認テーブルと
    //INNER JOIN users_table ユーザーテーブルを内部結合
    //ON approval_table.user_id = users_table.id
    //承認テーブルのユーザーidとユーザーテーブルのidを一致

    $stmt_appr = $pdo->prepare($sql_appr);
    $status_appr = $stmt_appr->execute();

    if ($status_appr == false) {
      $error = $stmt_appr->errorInfo();
      echo json_encode(["error_msg" => "{$error[2]}"]);
      exit();
    } else {
      $result_appr = $stmt_appr->fetchAll(PDO::FETCH_ASSOC);

      $result_appr2 = array_unique($result_appr);
      foreach ($result_appr2 as $record_appr) {

        if ($user_id == $record["created_by"]) {
          $output .= "<tr>";
          $output .= "<td class='title'>{$record["doc_title"]}</td>";
          $output .= "<td>{$record["doc_contents"]}</td>";
          $output .= "<td><a href='../filemgmt/file_upform.php?id={$record["id"]}' class='icon'><i class='fas fa-file-upload'></i></a></td>";
          $output .= "<td><div class='tooltip'>
          <span class='tooltip-text'>承認者: {$record_appr["approver"]}</span>
          <span><i class='fas fa-thumbs-up'></i> :{$record["cnt"]}</span></div></td>";
          $output .= "<td><a href='../filemgmt/doc_edit.php?id={$record["id"]}' class='icon'><i class='fas fa-pencil-alt'></i></a></td>";
          $output .= "<td><a href='../filemgmt/doc_delete.php?id={$record["id"]}' class='icon' onclick='return confirm_del();'><i class='fas fa-eraser'></i></a></td>";
          $output .= "</tr>";
        } else {
          $output .= "<tr>";
          $output .= "<td class='title'>{$record["doc_title"]}</td>";
          $output .= "<td>{$record["doc_contents"]}</td>";
          $output .= "<td><a href='../filemgmt/file_upform.php?id={$record["id"]}' class='icon'><i class='fas fa-file-upload'></i></a></td>";
          // $output .= "<td><a href='approval_create.php?user_id={$user_id}&doc_id={$record["id"]}'>承認</a></td>"; 
          $output .= "<td><div class='tooltip'>
          <span class='tooltip-text'>承認者: {$record_appr["approver"]}</span>
          <a href='../filemgmt/approval_create.php?user_id={$user_id}&doc_id={$record["id"]}' class='icon'><i class='far fa-thumbs-up'></i></a>
          <span> :{$record["cnt"]}</span>
          </div></td>";
          $output .= "<td><a href='../filemgmt/doc_edit.php?id={$record["id"]}' class='icon'><i class='fas fa-pencil-alt'></i></a></td>";
          $output .= "<td></td></tr>";
        }
      }
      unset($value);
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

    table {
      width: 100%;
      margin: auto auto 1em;
      text-align: left;
      border-collapse: collapse;
      border: 1px;
    }

    th {
      text-align: center;
      padding: 10px;
      border-bottom: 1px solid #a6a5c4;
      letter-spacing: 1em;
    }

    td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #a6a5c4;
    }

    td.title {
      text-align: left;
      padding-left: 20px;
    }
  </style>
</head>

<body class="read">
  <script>
    function confirm_del() {
      var select = confirm("本当に削除しますか？ \n「OK」で削除 \n「キャンセル」で中止");
      return select;
    }
  </script>
  <div class="wrap">
    <div class="sideNav_read">
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
            <tbody class="tbody_read">
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