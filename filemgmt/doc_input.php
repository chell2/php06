<?php
session_start();
include("../functions.php");
check_session_id();
$user_id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>文書登録</title>
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
      &emsp;<br>文<br>書<br>登<br>録<br>
    </div>
    <div class="content">
      <form action="../filemgmt/doc_create.php" method="POST">
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
                  件名:
                </th>
                <td>
                  <textarea rows="4" cols="100" name="doc_title"></textarea>
                </td>
              </tr>
              <tr>
                <th>
                  分類:
                </th>
                <td>
                  <textarea rows="2" cols="100" name="doc_contents"></textarea>
                </td>
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
            <button>登 録</button>
          </div>
          <input type="hidden" name="created_by" value="<?= $user_id ?>">
        </fieldset>
      </form>
    </div>
  </div>

</body>

</html>