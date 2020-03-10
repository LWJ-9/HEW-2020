<?php require_once "./system/common_admin.php";?>
<?php


// !--------------user_rows取得
try {
    $stmt = $db->prepare("SELECT c.* FROM users c");
    $stmt->execute(); // クエリの実行
    $rows_user = $stmt->fetchAll(PDO::FETCH_UNIQUE); // SELECT結果を配列に格納
    //var_dump($rows_user);
    $row_self = $db->query("SELECT * FROM users WHERE uid=" . $_SESSION["user_id"])->fetch();
} catch (PDOException $e) {
    // エラー発生時
    exit("'SELECT * FROM users'処理に失敗しました");
}
//! -------------posts_rows取得
$Rows_posts = $db->prepare("SELECT * FROM posts WHERE status = 1 AND ( pid = ? )");
$Rows_posts->execute(array($_GET['pid']));
$row_posts = $Rows_posts->fetch(); 
if(!$row_posts) header("Location: main.php");
?>
<?php
// !-------------follow 追加
if (@$_REQUEST['followSb']) {
  $stm = $db->prepare("SELECT * FROM followed WHERE uid = ? AND followed_uid = ?");
  $stm->execute( array( $_SESSION['user_id'] , $_REQUEST['followSb'] ));
  $folrow = $stm->fetch();
  if(!$folrow) {
  $stm = $db->prepare("INSERT INTO  followed (`uid`, `followed_uid`) VALUES (?, ?)");
  $stm->execute( array( $_SESSION['user_id'] , $_REQUEST['followSb'] ));
  }
}
// !-------------follow削除

if (@$_REQUEST['unfollowSb']) {
  $stm = $db->prepare("DELETE FROM followed WHERE `uid`=? AND `followed_uid`=?");
  $stm->execute([$_SESSION['user_id'], $_REQUEST['unfollowSb']]);
}
// !-------------follow取得
$stm = $db->prepare("SELECT followed_uid FROM followed WHERE uid = ? AND followed_uid= ?");
$stm->execute( [$_SESSION['user_id'], $row_posts["uid"]]);
$rows_fol = $stm->fetchAll(PDO::FETCH_UNIQUE);
// var_dump($rows_fol);
// var_dump($row_user["uid"]);
// !-------------post 削除
if(isset($_REQUEST['del_post'])){
  $statement = $db->prepare("UPDATE `posts` SET `status`='0' WHERE `pid`=?;");
  $statement->execute([$_REQUEST['del_post']]);

  }
// !-------------comment 追加
if(isset($_REQUEST['add_comm_pid']) && isset($_REQUEST['add_comm_comment'])){
  $statement = $db->prepare("INSERT INTO  comments (`pid`, `uid`, `content`) VALUES (?, ?, ?)");
  $statement->execute(array(
    $_REQUEST['add_comm_pid'] ,
    $_SESSION['user_id'],
    $_REQUEST['add_comm_comment'])
  );
}
// !-------------comment 削除
if(isset($_REQUEST['delete_comment'])){
  $statement = $db->prepare("DELETE FROM comments WHERE cid=?");
  $statement->execute([$_REQUEST['delete_comment']]);

  }
// !-------------comments_rows取得
$stmcom = $db->prepare("SELECT * FROM comments c WHERE pid = ?");
$stmcom->execute(array($_REQUEST['pid']));
$coms = $stmcom->fetchAll(PDO::FETCH_ASSOC);

// var_dump($row_posts);


// var_dump($coms);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/commen.css" />
  <link rel="stylesheet" href="css/post.css" />
  <title>main page</title>
</head>

<body>
  <div class="wrap">
    <nav>
      <?php require "nav.html"; ?>
    </nav>
    <main>

      <div class="main_box">
        <div class="box">



          <div class="left">

          <?php if ($row_posts["media"] > 0): ?>
            <div class="img_box">
                <img src="images/posts/<?=$row_posts["media"];?>" alt=""
                  onclick="window.location = 'post.php?pid=<?=$row_posts["pid"];?>';">
            </div>
          <?php endif; ?>


                <?php if (strlen($row_posts["text"]) > 0): ?>
                <p class="text_box" style="word-break: break-all; "><?=he($row_posts["text"]) ;?></p>
                <?php endif; ?>
                <p></p>
          </div>




          <div class="right">
            <section class="header">
              <img src="./images/user/<?=@$rows_user[$row_posts["uid"]]["picture"]; ?>" alt="">
              <span><?=@$rows_user[$row_posts["uid"]]["name"]; ?></span>

              <form action="" method="post">

                <?php if($row_posts['uid']==$_SESSION['user_id']) : ?>
                <button type="submit" name="del_post" value="<?=$row_posts["pid"]; ?>">
                  <i class="fas fa-eraser fa-2x fa-fw" title="delete"></i>
                </button>
                <?php endif; ?>

                <?php if($row_posts['uid'] !=$_SESSION['user_id']) : ?>
                  <button type="submit" name="<?=isset($rows_fol[$row_posts["uid"]]) ? 'unfollowSb' : 'followSb' ; ?>" value="<?=$row_posts["uid"]; ?>">
                    <i class="fas <?=isset($rows_fol[$row_posts["uid"]]) ? 'fa-user-minus' : 'fa-user-plus' ; ?> fa-2x fa-fw" title="follow"></i>
                  </button>
                <?php endif; ?>

              </form>
            </section>


            <!-- //!comment main -->
            <section class="main">
            <?php if(isset($coms)) : 
                    foreach($coms as $com): ?>
                <!-- commen area -->
                <div class="text_row">
                  <span class="commName"><?=$rows_user[$com['uid']]['name']; ?>:</span>
                  <span class="commText"><?=$com['content']; ?></span>
                  <?php if($com['uid']==$_SESSION['user_id'] || $row_posts['uid']==$_SESSION['user_id']) : ?>
                  <!-- -------------comment delete button -->
                  <form action="#<?=$row_posts["pid"]; ?>" method="post">
                    <button type="submit" name="delete_comment" value="<?=$com['cid']; ?>">
                      <i class="far fa-trash-alt fa-fw" title="delete"></i>
                    </button>
                  </form>
                  <?php endif; ?>
                </div>
                <?php endforeach;
                endif; ?>
            </section>
            <section class="cta">
            <form action="#<?=$row_posts["pid"]; ?>" method="post" class="add_comment">
                  <input type="hidden" name="add_comm_pid" value="<?=$row_posts['pid'];?>">
                  <input type="text" name="add_comm_comment" id="" placeholder="Add a comment">
                  <input type="submit" value="Post">
                </form>
            </section>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>