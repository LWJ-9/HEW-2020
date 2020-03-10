<?php require_once "./system/common_admin.php";?>


<?php

// ホワイトリスト変数の作成
$whitelist = array("send", "text", "uid");
$request = whitelist($whitelist);
?>

<?php

// ! ! get  user  row
// var_dump($_SESSION);
try {
    $stmt = $db -> prepare("SELECT * FROM users WHERE uid= ?");
    $stmt -> execute([$request['uid']]); // クエリの実行
    $row_user = $stmt -> fetch(); // SELECT結果を配列に格納
} catch (PDOException $e) {
    // エラー発生時
    exit("ログイン処理に失敗しました");
}

//! -------------posts_rows取得

$Rows_posts = $db->prepare("SELECT * FROM posts WHERE status = 1 AND uid = ? ORDER BY post_time DESC");
$Rows_posts->execute(array($request['uid']));
$rows_posts = $Rows_posts->fetchAll(); // SELECT結果を配列に格納

?>
<?php
  $stmt = $db -> prepare("SELECT COUNT(*) FROM followed WHERE uid= ?");
  $stmt -> execute([$request['uid']]); // クエリの実行
  $followCount = $stmt -> fetchColumn(); // SELECT結果を配列に格納
  $stmt = $db -> prepare("SELECT COUNT(*) FROM followed WHERE followed_uid= ?");
  $stmt -> execute([$request['uid']]); // クエリの実行
  $followByCount = $stmt -> fetchColumn(); // SELECT結果を配列に格納
?>


<?php
//post hand in
// var_dump($_FILES, $request["text"]);
if (isset($request["send"])) {
    if ($_FILES['image']['size'] == 0 && strlen($request["text"]) == 0) {
        $page_error[0] = "内容を入力してください\n";
    } else {
        if ($_FILES['image']['size'] != 0) {
            $image = date('YmdHis') . '-'. $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], './images/posts/' .$image);
        //$_SESSION['join'] = $_POST;
            //$_SESSION['join']['image'] = $image;
        } else {
            $image = '';
        }
        $statement = $db->prepare('INSERT INTO posts SET uid=?, media=?, text=?');
        echo $ret = $statement->execute(array(
          $_SESSION['user_id'],
          $image,
          $request['text']
        ));
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
  <link rel="stylesheet" href="css/user.css" />
  <title>self page</title>
  <script type="text/javascript">
    function imgPreview(fileDom) {
      //chech FileReader function
      if (window.FileReader) {
        var reader = new FileReader();
      } else {
        alert("your browser do not support images preview function, please get update");
      }

      //get file
      var file = fileDom.files[0];
      var imageType = /^image\//;
      //isimages?
      if (!imageType.test(file.type)) {
        alert("please choose image type file！");
        return;
      }
      //load complete
      reader.onload = function (e) {
        //get img dom
        var img = document.getElementById("preview");
        //set pic file to img dom
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  </script>
</head>

<body>
  <div class="wrap">
    <nav>
      <?php require "nav.html"; ?>
    </nav>
    <main>
      <div class="mainbox flexbox">
        <div class="box">
          <section class="icon">
            <img src="./images/user/<?=$row_user['picture'];?>" alt="">
          </section>
          <section class="text flexbox">
            <h1><?=$row_user['name']; ?></h1>
            <ul>
              <li> <span><?=count($rows_posts);?> posts</span></li>
              <li> <span><?=$followByCount;?> followers</span></li>
              <li> <span><?=$followCount;?> following</span></li>
            </ul>
            <h2>self intro:<?=$row_user['self_intro']; ?></h2>
            <h3>
            <?php if($_GET['uid'] == $_SESSION['user_id']): ?>
              <a href="login.php">log out</a>
              <?php endif ;?>
            </h3>
          </section>
          <section class="upload flexbox">
            <?php if($_GET['uid'] == $_SESSION['user_id']): ?>
            <div class="pre_box">
              <img id="preview" />
            </div>
            <form class="up" action="" method="post" enctype="multipart/form-data">
              <label for="image">image upload here</label>
              <label style="color: rgb(239, 187, 191)"><?php if(isset($ret)) echo 'Upload OK';?></label>
              <input type="file" name="image" id="image" onchange="imgPreview(this);preview.style.opacity = 1;">
              <textarea name="text" id="text" cols="30" rows="10"></textarea>
              <button type="submit" name="send" value="1">upload</button>
              <p><?=@$page_error[0]; ?></p>
            </form>
  <?php endif ;?>

          </section>
        </div>
      </div>
    </main>
  </div>
  <script>
    if(document.querySelector('.upload')){
      item = document.querySelector('.topRightBtn i.fa-user-circle');
      item.classList.remove('far');
      item.classList.add('fas');
    }
  </script>
</body>

</html>