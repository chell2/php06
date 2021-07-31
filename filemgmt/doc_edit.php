<?php
session_start();
include("../functions.php");
check_session_id();
$user_id = $_SESSION["id"];

$id = $_GET["id"];
$pdo = connect_to_db();

$sql = 'SELECT * FROM document_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>文書編集</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/filemgmt.css">
  <style>
    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    ::-webkit-scrollbar-track {
      box-shadow: 0 0 5px #4e54c8 inset;
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background: #a6a5c4;
      border-radius: 5px;
    }

    table {
      width: auto;
      margin: auto;
      text-align: left;
    }

    th {
      letter-spacing: .5em;
    }

    td {
      padding: 5px 2px;
    }
  </style>
</head>

<body class="inp">
  <div class="wrap">
    <div class="sideNav_input">
      &emsp;<br>文<br>書<br>編<br>集<br>
    </div>
    <div class="content">
      <form action="../filemgmt/doc_update.php" method="POST">
        <fieldset>
          <p hidden><?= $user_id ?>:<?= $_SESSION["position"] ?>:<?= $_SESSION["username"] ?></p>
          <!-- <legend>文書編集</legend> -->
          <div>
            <a href="../filemgmt/doc_read.php">一覧画面</a>
          </div>
          <div>
            <table>
              <tr>
                <th>
                  件名:
                </th>
                <td>
                  <textarea rows="4" cols="100" name="doc_title"><?= $record["doc_title"] ?></textarea>
                </td>
              </tr>
              <tr>
                <th>
                  分類:
                </th>
                <td>
                  <textarea rows="2" cols="100" name="doc_contents"><?= $record["doc_contents"] ?></textarea>
                <td>
              </tr>
              <!-- <tr>
                <th>
                  添付:
                </th>
                <td>
                  <input type="file" name="upfile" accept="text/plain,image/*,.pdf,.csv,.xls,.xlsx,.doc,.docx">
                </td>
              </tr>
              </th>
              <tr>
                <th>
                  備考:
                </th>
                <td>
                  <textarea rows="2" cols="100" name="caption" placeholder="*添付資料の説明：140文字以下" id="caption"></textarea>
                </td>
              </tr> -->
            </table>
          </div>
          <div class="btn">
            <button>更 新</button>
          </div>
          <input type="hidden" name="id" value="<?= $record["id"] ?>">
          <input type="hidden" name="updated_by" value="<?= $user_id ?>">
        </fieldset>
      </form>
    </div>
  </div>
</body>

</html>