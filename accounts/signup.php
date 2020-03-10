<?php

require_once "../system/common.php";
session_start();


// echo var_dump($_FILES);

if (!empty($_POST)) {
    // エラー項目の確認
    if ($_POST['name'] == '') {
        $error['name'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] == '') {
        $error['password'] = 'blank';
    }
    if ($_POST['passwordcheck'] != $_POST['password']) {
        $error['passwordcheck'] = 'notEqual';
    }
    //!check point
    if (isset($error)) {
        var_dump($error);
    }
    
    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != ('jpg' or 'gif' or 'png' or 'bmp')) {
            $error['image'] = 'type';
        }
    }

    // 重複アカウントのチェック
    if (empty($error)) {
        $member = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE	name=?');
        $member->execute(array($_POST['name']));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['name'] = 'duplicate';
        }
    }
    if (isset($error)) {
        var_dump($error);
    }
    if (empty($error)) {
        // 画像をアップロードする
        if ($_FILES['image']['size'] != 0) {
            $image = date('YmdHis') . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../images/user/' .$image);
            $_SESSION['join'] = $_POST;
            $_SESSION['join']['image'] = $image;
        } else {
            $image = 'default.png';
        }

    }
    if (empty($error)) {
        // 登録処理をする
        $statement = $db->prepare('INSERT INTO users SET name=?,  password=?, picture=?');
        echo $ret = $statement->execute(array(
                $_POST['name'],
                sha1($_POST['password']),
                $image
            ));
    }

// ログイン実行
    if (empty($error)) {
        try {
            // まずはログインIDでSELECTする
            $stmt = $db->prepare("SELECT * FROM users WHERE name = ? LIMIT 1");
            $stmt->execute(array($_POST['name'])); // クエリの実行
            $row_user = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
            
            if ($row_user) {
                // 該当のuserレコードがあったら、パスワードを照合する
                    $_SESSION["user_id"] = $row_user["uid"];
                    $_SESSION["user_name"] = $row_user["name"];
                    $_SESSION["user_password"] = $row_user["password"];
                    header("Location: ../main.php");
                    exit;
            }
        } catch (PDOException $e) {
            // エラー発生時==
            exit("ログイン処理に失敗しました");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../css/commen.css" />
    <link rel="stylesheet" href="../css/login.css" />

    <title>Sign up Page</title>
</head>

<body>
    <main>
        <div>
            <article>
                <div>
                    <div class="stddiv ">
                        <h1 class="title">
                            sign up
                        </h1>
                        <div class="signupdiv">
                            <form class="" action="" method="post" enctype="multipart/form-data">

                                <div class="textholder">
                                    <div class="username font">User Name<span class="required">必須</span></div>
                                    <input autocapitalize="off" autocorrect="off" maxlength="50" autocomplete="off"
                                        name="name" type="text" class="username" value="" />
                                    <?php if (@$error['name'] == 'blank'): ?>
                                    <p class="error">* ニックネームを入力してください</p>
                                    <?php endif; ?>
                                    <?php if (isset($error['name'])) {
    if ($error['name'] == 'duplicate'): ?>
                                    <p class="error">* 指定されたニックネームはすでに登録されています</p>
                                    <?php endif;
} ?>
                                </div>


                                <div class="textholder">
                                    <div class="password font">Password<span class="required">必須</span></div>
                                    <input maxlength="75" autocapitalize="off" autocorrect="off" name="password"
                                        type="password" class="password" value="" />
                                    <?php if (@$error['password'] == 'blank'): ?>
                                    <p class="error">* パスワードを入力してください</p>
                                    <?php endif; ?>
                                    <?php if (@$error['password'] == 'length'): ?>
                                    <p class="error">* パスワードは4文字以上で入力してください</p>
                                    <?php endif; ?>
                                </div>

                                <div class="textholder">
                                    <div class="password font">Password<span class="required">必須</span></div>
                                    <input maxlength="75" autocapitalize="off" autocorrect="off" name="passwordcheck"
                                        type="password" class="passwordcheck" value="" />
                                    <?php if (@$error['passwordcheck'] == 'notEqual'): ?>
                                    <p class="error">* パスワードが一致しないようです</p>
                                    <?php endif; ?>
                                </div>

                                <div class="textholder">
                                    <div class="font">Icon</div>
                                    <input type="file" autocapitalize="off" autocorrect="off" name="image" class="image"
                                        value="" />
                                    <?php if (@$error['image'] == 'type'): ?>
                                    <p class="error">* 写真などは「.gif」、「.png」または「.jpg」の画像を指定してください
                                    </p>
                                    <?php endif; ?>
                                    <?php if (!empty($error)): ?>
                                    <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                                    <?php endif; ?>
                                </div>

                                <div class="submit_outter">
                                    <button class="" type="submit" name="send">
                                        <div class=" submit_inner">Sign Up </div>
                                    </button>
                                </div>
                                <div class="goback_outter">
                                    <a href="../login.php">
                                        <button class="" type="button">
                                            <div class="">Go Back </div>
                                        </button>
                                    </a>
                                </div>
                            </form>
                        </div>
            </article>
        </div>
    </main>
</body>

</html>