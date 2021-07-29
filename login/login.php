<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>文書管理システム：ログイン画面</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/loginstyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300&family=Montserrat:wght@600&display=swap" rel="stylesheet">
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

    a:hover {
      text-decoration: none;
      background: linear-gradient(transparent 0%, #a6a5c4 0%);
      color: #fff;
      border-bottom: 1px solid #a6a5c4;
    }
  </style>

</head>

<body class="log">
  <form action="../login/login_act.php" method="POST">
    <fieldset>
      <div>
        <br>
        <!-- <legend>文書管理システム：ログイン画面</legend> -->
        <table>
          <tr>
            <td>
              職員ID:
            </td>
            <td>
              <input type="text" name="username">
            </td>
          </tr>
          <tr>
            <td>
              パスワード:
            </td>
            <td>
              <input type="password" name="password">
            </td>
          </tr>
        </table>
        <div>
          <button>ログイン</button>
        </div>
        <div class="link">
          <a href="../register/register.php">>> ID登録</a>
        </div>
    </fieldset>
    </div>
  </form>
  <div class="title">
    <h1>File Management System</h1>
  </div>
  <div class="separator">
    <svg class="separator__svg" width="100%" height="400" viewBox="0 0 100 100" preserveAspectRatio="none" fill="#4e54c8" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <path d="M 100 100 V 10 L 0 100" />
      <!-- <path d="M 30 73 L 100 18 V 10 Z" fill="#3E1DB3" stroke-width="0" /> もう一色重ねる場合-->
    </svg>
  </div>
  <script>
    function pushHideButton() {
      var txtPass = document.getElementById("txtPass");
      var btnEye = document.getElementById("btnEye");
      if (txtPass.type === "text") {
        txtPass.type = "password";
        btnEye.className = "fa fa-eye";
      } else {
        txtPass.type = "text";
        btnEye.className = "fa fa-eye-slash";
      }
    }
  </script>
</body>

</html>