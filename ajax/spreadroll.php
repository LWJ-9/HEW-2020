<?php require_once "../system/common_admin.php";?><?php

// session_start();
// var_dump($_REQUEST);
// var_dump($_SESSION);

$stmt = $db->prepare("SELECT uid , c.* FROM users c");
$stmt->execute(); // クエリの実行
$rows_user = $stmt->fetchAll(PDO::FETCH_UNIQUE); // SELECT結果を配列に格納
//var_dump($rows_user);
// $row_self = $db->query("SELECT * FROM users WHERE name=" . $_SESSION["user_name"])->fetch();

$Rows_posts = $db->prepare("SELECT * FROM posts WHERE status = 1 AND( uid =? OR `uid` IN (SELECT followed_uid FROM followed WHERE uid =? )) ORDER BY post_time DESC LIMIT ? OFFSET ?");
$Rows_posts->execute(array($_SESSION['user_id'] , $_SESSION['user_id'], $_REQUEST['rows'], $_REQUEST['offest']));
$rows_posts = $Rows_posts->fetchAll(PDO::FETCH_ASSOC); // SELECT結果を配列に格納

if (!function_exists('base_url')) {
  function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
      if (isset($_SERVER['HTTP_HOST'])) {
          $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
          $hostname = $_SERVER['HTTP_HOST'];
          $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

          $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
          $core = $core[0];

          $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
          $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
          $base_url = sprintf( $tmplt, $http, $hostname, $end );
      }
      else $base_url = 'http://localhost/';

      if ($parse) {
          $base_url = parse_url($base_url);
          if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
      }

      return $base_url;
  }
}

// !-------------renderHTML/liked_text_boxを編集
$stat = $db->prepare("SELECT pid FROM posts WHERE ( uid = ? OR `uid` IN (SELECT followed_uid FROM followed WHERE uid = ? ))");
$stat->execute(array($_SESSION['user_id'] , $_SESSION['user_id']));
$rows_pid = $stat->fetchAll(PDO::FETCH_COLUMN); // SELECT結果を配列に格納
// var_dump($rows_pid);
if(count($rows_pid) >1){

$in  = str_repeat('?,', count($rows_pid) - 1) . '?';
$sql_1 = "SELECT pid , uid , t.* FROM thumbup t WHERE pid IN ($in) ORDER BY `add_time` DESC ";
$stm = $db->prepare($sql_1);
$stm->execute($rows_pid);
$rows_like = $stm->fetchAll(PDO::FETCH_GROUP);
// var_dump($rows_like);

$sql_2 = "SELECT pid, count(*) FROM thumbup  WHERE pid IN ($in) GROUP BY pid";
$stm = $db->prepare($sql_2);
$stm->execute( $rows_pid);
$count_rows = $stm->fetchAll(PDO::FETCH_KEY_PAIR);
// var_dump($count_rows);
}
?><?php foreach ($rows_posts as $row_posts):  



  $sql_3 = "SELECT pid , t.* FROM thumbup t WHERE pid = ? AND uid = ? ORDER BY `add_time` DESC ";
$stm = $db->prepare($sql_3);
$stm->execute( array(
  $row_posts['pid'] , 
  $_SESSION['user_id']
  ) );
$row_like = $stm->fetchAll();
// var_dump($row_like);

  if(count($row_like) > 0){
    $like_flag = true;
  } else if(count($row_like) ==0 ){
    $like_flag = false;
  }

  // !-------------comments_rows取得
$stmcom = $db->prepare("SELECT pid , c.* FROM comments c WHERE pid IN ( SELECT pid FROM posts WHERE uid =? OR uid IN (SELECT followed_uid FROM followed WHERE uid =? ))");
$stmcom->execute(array($_SESSION['user_id'], $_SESSION['user_id']));
$coms = $stmcom->fetchAll(PDO::FETCH_GROUP);
?>
    <article id="<?=$row_posts["pid"]; ?>">
      <!-- header area -->
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
          <button type="submit" name="unfollowSb" value="<?=$row_posts["uid"]; ?>">
            <i class="fas fa-user-minus fa-2x fa-fw" title="unfollow"></i>
          </button>
          <?php endif; ?>

        </form>
      </section>
      <section class="main">

        <?php if ($row_posts["media"] > 0): ?>
        <img src="images/posts/<?=$row_posts["media"];?>" alt=""
          onclick="window.location = 'post.php?pid=<?=$row_posts["pid"];?>';">
        <?php endif; ?>

        <?php if (strlen($row_posts["text"]) > 0): ?>
        <p class="text_box"><?=he($row_posts["text"]) ;?></p>
        <?php endif; ?>

      </section>
      <section class="button_area">
        <i class="<?=$like_flag ? 'fas' : 'far' ; ?> fa-heart fa-2x fa-fw"
          onclick="this.classList.toggle('far') ; this.classList.toggle('fas') ; pushtodb(this);"></i>
        <i class="far fa-comment fa-2x fa-fw"
          onclick="window.location = 'post.php?pid=<?=$row_posts['pid']; ?>';"></i>
        <i class="far fa-share-square fa-2x fa-fw"
          onclick="this.nextElementSibling.hidden = this.nextElementSibling.hidden == true?false:true"></i>
        <div class="share" hidden>
          <input type="text" name="url[]" class="shareLinkText"
            value="<?=base_url() . 'post.php?pid=' . $row_posts['pid'];  ?>">
          <input type="button" value="COPY" class="copyBtn" onclick="this.previousElementSibling.select();	
          document.execCommand('Copy'); alert(' COPY DONE');">
        </div>
        <i class="far fa-bookmark fa-2x fa-fw right_icon"
          onclick="this.className = this.className=='far fa-bookmark fa-2x fa-fw right_icon' ? 'fas fa-bookmark fa-2x fa-fw right_icon' :'far fa-bookmark fa-2x fa-fw right_icon'      "></i>
      </section>
      <section class="pub_time">
        <p>Post time:<?=$row_posts['post_time']; ?></p>
      </section>
      <section class="liked_text">
      <p class="liked_text_box">
  <?php 
  // var_dump($rows_like);
  // var_dump($row_posts);
  $pid = ''.$row_posts['pid'];
  if(isset( $rows_like[$pid][0]) ): ?>
                  Liked by
                  <a class="" title="<?=$rows_user[$rows_like[$pid][0]['uid']]['name'];?>" href="./user.php?uid=<?=$rows_like[$pid][0]['uid'];?>">
                    <?=$rows_user[$rows_like[$pid][0]['uid']]['name'];?>
                  </a><?php if($count_rows[$pid] != 1): ?>
                  and <span><?=$count_rows[$pid] - 1;?></span> others<?php endif; ?>
  <?php endif; ?>
  <?php if(!isset( $rows_like[$pid][0])): ?>
                  no one pushed the like button yet.
  <?php endif; ?>
                </p>
      </section>
      <div class="comment">

        <?php if(isset($coms[$row_posts['pid']])) : 
        $i = 0; 
        foreach($coms[$row_posts['pid']] as $com): 
        $i++;if($i > 2) break;
        ?>
        <!--//! commen area -->
        <div class="text_row">
          <span class="commName"><?=@$rows_user[$com['uid']]['name'];?></span>
          <span class="commText">:<?=@$com['content'];?></span>
          <?php if($com['uid']==$_SESSION['user_id'] || $row_posts['uid']==$_SESSION['user_id']) : ?>
          <!--//!-------------comment delete button -->
          <form action="#<?=$row_posts["pid"]; ?>" method="post">
            <button type="submit" name="delete_comment" value="<?=$com['cid']; ?>">
              <i class="far fa-trash-alt fa-fw" title="delete"></i>
            </button>
          </form>
          <?php endif; ?>
        </div>
        <?php endforeach;
        endif; ?>
        <?php if(@count($coms[$row_posts['pid']]) > 2): ?>
        <a href="post.php?pid=<?=$row_posts["pid"];?>" class="show_all_comments">show all
          <?=count($coms[$row_posts['pid']]);?> comments</a>
        <?php endif; ?>
        <form action="#<?=$row_posts["pid"]; ?>" method="post" class="add_comment">
          <input type="hidden" name="add_comm_pid" value="<?=$row_posts['pid'];?>">
          <input type="text" name="add_comm_comment" id="" placeholder="Add a comment">
          <input type="submit" value="Post">
        </form>
      </div>

    </article>
    <?php endforeach; ?>