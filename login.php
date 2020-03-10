<?php $ignore_login = true;?>
<?php require_once "./system/common_admin.php";?>
<?php
session_destroy();
session_start();
// var_dump($_REQUEST);
// ホワイトリスト変数の作成
$whitelist = array("send", "user_loginid", "user_password");
$request = whitelist($whitelist);
// if (isset($_REQUEST["send"])) {
//     echo $_REQUEST["send"] . "<br>";
//     echo $_REQUEST["user_loginid"];
//     echo $_REQUEST["user_password"];
//     var_dump($_REQUEST["send"]);
// }
$page_message = ""; // ページに表示するメッセージ
$page_error = ""; // エラーメッセージ
// エラーチェック
if (isset($request["send"])) {
    if ($request["user_loginid"] == "") {
        $page_error .= "ログインIDを入力してください\n";
    }
    if ($request["user_password"] == "") {
        $page_error .= "パスワードを入力してください\n";
    }
}

// ログイン実行
if (isset($request["send"]) && $page_error == "") {
    try {
        // まずはログインIDでSELECTする
        $stmt = $db->prepare("SELECT * FROM users WHERE name = ? LIMIT 1");
        $stmt->execute(array($request["user_loginid"])); // クエリの実行
        $row_user = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
        
        if ($row_user) {
            // 該当のuserレコードがあったら、パスワードを照合する
            if (sha1($request["user_password"]) == $row_user["password"]) {
                $_SESSION["user_id"] = $row_user["uid"];
                $_SESSION["user_name"] = $row_user["name"];
                $_SESSION["user_password"] = $row_user["password"];
                header("Location: main.php");
                exit;
            }
        }
        $page_error .= "入力内容をご確認ください\n";
    } catch (PDOException $e) {
        // エラー発生時==
        exit("ログイン処理に失敗しました");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/commen.css" />
  <link rel="stylesheet" href="css/login.css" />

  <title>Log In Page</title>
</head>

<body>
  <main>
    <div>
      <article>
        <div>
          <div class="stddiv ">
            <h1 class="title">
              Simplex
            </h1>
            <div class="logindiv">
              <form class="" action="./login.php" method="post">

                <div class="textholder">
                  <div class="username font">Username</div>
                  <input aria-label="username" aria-required="true" autocapitalize="off" autocorrect="off"
                    maxlength="75" autocomplete="off" name="user_loginid" type="text" class="username" value="" />
                </div>


                <div class="textholder   ">
                  <div class="password font">Password</div>
                  <input aria-label="Password" aria-required="true" autocapitalize="off" autocorrect="off"
                    name="user_password" type="password" class="password" value="" />
                </div>


                <p style="text-align:center;">
                  <?php echo nl2br(he($page_error)); ?>
                </p>

                <div class="submit_outter">
                  <button class="3333" type="submit" name="send">
                    <div class=" submit_inner">Log In </div>
                  </button>
                </div>

                <div class="or_area font">
                  <div class="slash"></div>
                  <div class="or">or</div>
                  <div class="slash"></div>
                </div>

                <div class="">
                  <button class="" type="button" onclick="window.location = 'accounts/signup.php';">
                    <span class="bb2" >Sign up</span>
                  </button>
                </div>

                <a class="33333" href="./accounts/reset">Forgot password?</a>
              </form>
            </div>
          </div>

          <div class="stddiv">
            <div class="textcenter">
              <p class="textcenter">
                Don't have an account?
                <a href="./accounts/signup.php"><span class="sign_up">Sign up</span></a>
              </p>
            </div>
          </div>
        </div>
      </article>
    </div>
  </main>
</body>

</html>