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
  <style>
    fieldset {
      width: 1200px;
      margin: 3em auto;
      text-align: center;
      border-radius: 5px;
      border: solid 2px #999;
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

    div {
      margin-top: 1em;
    }

    a {
      color: blue;
      text-decoration: none;
      border-bottom: 1px solid blue;
    }

    a:active:visited {
      text-decoration: none;
      border-bottom: 1px solid blue;
    }

    a:hover {
      text-decoration: none;
      border-bottom: 3px solid blue;
    }

    div.btn {
      margin-bottom: 2em;
    }

    button {
      width: 80px;
    }
  </style>
</head>

<body>
  <form action="../filemgmt/doc_update.php" method="POST">
    <fieldset>
      <p hidden><?= $user_id ?>:<?= $_SESSION["position"] ?>:<?= $_SESSION["username"] ?></p>
      <legend>文書編集</legend>
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
              <textarea rows="2" cols="100" name="doc_title"><?= $record["doc_title"] ?></textarea>
            </td>
          </tr>
          <tr>
            <th>
              分類:
            </th>
            <td>
              <textarea rows="4" cols="100" name="doc_contents"><?= $record["doc_contents"] ?></textarea>
            <td>
          </tr>
          <tr>
            <th>
              添付:
            </th>
            <td>
              <input type="file" name="upfile" accept=".txt,.csv,.xls,.xlsx,.xlsb,.xlsm,.doc,.docx,.docm,.rtf,.pptx,.ppt,.pptm,.pps,.ppsx,.ppsm,.pdf,.png,.jpg,.jpeg,.gif,.tiff,.bmp">
            </td>
          </tr>
        </table>
      </div>
      <div class="btn">
        <button>更 新</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
      <input type="hidden" name="updated_by" value="<?= $user_id ?>">
    </fieldset>
  </form>

</body>

</html>