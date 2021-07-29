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

    * {
      margin: 0;
    }

    body {
      background-color: #4e54c8;
    }

    .wrap {
      margin-top: 0;
      width: 100%;
      display: flex;
      align-items: flex-start;
    }

    .sideNav {
      width: 5vw;
      background-color: #4e54c8;
      color: #fff;
      text-align: center;
    }

    .content {
      margin-top: 0;
      width: 95vw;
      min-height: 100vh;
      background-color: #fff;
    }

    fieldset {
      width: 98%;
      margin: 5% auto;
      text-align: center;
      border-radius: 10px;
      border: none;
      background-color: rgba(255, 255, 255, .9);
      position: relative;
      z-index: 100;
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
      color: #4e54c8;
      text-decoration: none;
      border-bottom: 1px solid #4e54c8;
    }

    a:active:visited {
      text-decoration: none;
      border-bottom: 1px solid #4e54c8;
    }

    a:hover {
      text-decoration: none;
      border-bottom: 3px solid #4e54c8;
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
  <div class="wrap">
    <div class="sideNav">
      &emsp;<br>文<br>書<br>登<br>録<br>
    </div>
    <div class="content">
      <form action="../filemgmt/create_file.php" method="POST" enctype="multipart/form-data">
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
                  <textarea rows="2" cols="100" name="doc_title"></textarea>
                </td>
              </tr>
              <tr>
                <th>
                  分類:
                </th>
                <td>
                  <textarea rows="1" cols="100" name="doc_contents"></textarea>
                </td>
              </tr>
              <tr>
                <th>
                  添付:
                </th>
                <td>
                  <input type="file" name="upfile" accept="text/plain,text/csv,application/pdf,image/png,image/jpeg,image/gif">
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
              </tr>
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