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
  <title>ファイル登録</title>
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

    img {
      max-width: 290px;
      max-height: 290px;
    }
  </style>
</head>

<body class="inp">
  <div class="wrap">
    <div class="sideNav_input">
      &emsp;<br>フ<br>ァ<br>イ<br>ル<br>登<br>録<br>
    </div>
    <div class="content">
      <form action="../filemgmt/file_upload.php" method="POST" enctype="multipart/form-data">
        <fieldset>
          <p hidden><?= $user_id ?>:<?= $_SESSION["position"] ?>:<?= $_SESSION["username"] ?></p>
          <!-- <legend>文書登録</legend> -->
          <div>
            <a href="../filemgmt/doc_read.php">文書一覧</a> / <a href="../login/logout.php">ログアウト</a>
          </div>
          <div>
            <table>
              <tr>
                <th>
                  添付資料:
                </th>
                <td>
                  <input type="file" name="upfile" accept="text/plain,image/*,.pdf,.csv,.xls,.xlsx,.doc,.docx">
                </td>
              </tr>
              </th>
              <tr>
                <th>
                  備　　考:
                </th>
                <td>
                  <textarea rows="2" cols="100" name="caption" placeholder="資料の説明（140文字まで）" id="caption"></textarea>
                </td>
              </tr>
            </table>
          </div>
          <div class="btn">
            <button>登 録</button>
          </div>
          <input type="hidden" name="doc_id" value="<?= $record["id"] ?>">
          <input type="hidden" name="uploaded_by" value="<?= $user_id ?>">
        </fieldset>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
  </script>
  <script>
    $(function() {
      $('input[type=file]').after('<span></span>');

      // アップロードするファイルを選択
      $('input[type=file]').change(function() {
        var file = $(this).prop('files')[0];
        // ファイル表示
        var reader = new FileReader();
        reader.onload = function() {
          var img_src = $('<img>').attr('src', reader.result);
          $('span').html(img_src);
        }
        reader.readAsDataURL(file);
      });
    });
  </script>

</body>

</html>