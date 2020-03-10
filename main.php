<?php require_once "./system/common_admin.php";?>
<?php


// !--------------user_rows取得
// try {
    $stmt = $db->prepare("SELECT uid , c.* FROM users c");
    $stmt->execute(); // クエリの実行
    $rows_user = $stmt->fetchAll(PDO::FETCH_UNIQUE); // SELECT結果を配列に格納
    // var_dump($rows_user);
    // $row_self = $db->query("SELECT * FROM users WHERE name=" . '`' .$_SESSION["user_name"].'`')->fetch();
// } catch (PDOException $e) {
//     // エラー発生時
//     exit("'SELECT * FROM users'処理に失敗しました");
// }
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
$stm = $db->prepare("SELECT followed_uid FROM followed WHERE uid = ? ");
$stm->execute( array( $_SESSION['user_id'] ));
$rows_fol = $stm->fetchAll(PDO::FETCH_UNIQUE);
// var_dump($rows_fol);
?>

<?php
// var_dump($_SESSION);
// !-------------post 削除
if(isset($_REQUEST['del_post'])){
  $statement = $db->prepare("UPDATE `posts` SET `status`='0' WHERE `pid`=?;");
  $statement->execute([$_REQUEST['del_post']]);

  }
//! -------------posts_rows取得

    $Rows_posts = $db->prepare("SELECT pid , p.* FROM posts p WHERE status = 1 AND( uid =? OR `uid` IN (SELECT followed_uid FROM followed WHERE uid =? ))ORDER BY post_time DESC LIMIT 5");
    $Rows_posts->execute(array($_SESSION['user_id'] , $_SESSION['user_id']));
    $rows_posts = $Rows_posts->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC); // SELECT結果を配列に格納
    // var_dump($rows_posts);


// count($_REQUEST)> 0 ? var_dump($_REQUEST) : '';
// !-------------rendelikedttext    いいねを編集
// $Rows_posts->execute(array($_SESSION['user_id'] , $_SESSION['user_id']));
// $pidarr = $Rows_posts->fetchAll(PDO::FETCH_COLUMN);
//     var_dump($pidarr);
// if(count($pidarr) >1){
// $in  = str_repeat('?,', count($pidarr) - 1) . '?';
// $sql = "SELECT pid , t.* FROM thumbup t WHERE uid = ? AND pid IN ($in) ORDER BY add_time desc";
// $stm = $db->prepare($sql);
// $stm->execute( array_merge([$_SESSION['user_id']], $pidarr));
// $row_like = $stm->fetchAll(PDO::FETCH_UNIQUE| PDO::FETCH_COLUMN);
// var_dump($row_like);

// $stm = $db->prepare("SELECT pid , COUNT(*) FROM thumbup WHERE pid IN ($in) GROUP by pid");
// $stm->execute($pidarr);
// $count_rows = $stm->fetchAll(PDO::FETCH_KEY_PAIR);
// var_dump($count_rows);
// }

?>
<?php  
//! -------------$url取得

        // if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        //     $url = "https://";   
        // else  
        //     $url = "http://";   
        // // Append the host(domain name, ip) to the URL.   
        // $url.= $_SERVER['HTTP_HOST'];   
        
        // // Append the requested resource location to the URL   
        // // $url.= $_SERVER['REQUEST_URI'];    
        

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
      // echo base_url();    //  will produce something like: http://stackoverflow.com/questions/2820723/
      // echo base_url(TRUE);    //  will produce something like: http://stackoverflow.com/
      // echo base_url(TRUE, TRUE); 
      // echo base_url(NULL, TRUE);    //  will produce something like: http://stackoverflow.com/questions/
      // //  and finally
      // var_dump(base_url(NULL, NULL, TRUE));
      ?>

<?php

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
$stmcom = $db->prepare("SELECT pid , c.* FROM comments c WHERE pid IN ( SELECT pid FROM posts WHERE uid =? OR uid IN (SELECT followed_uid FROM followed WHERE uid =? ))");
$stmcom->execute(array($_SESSION['user_id'], $_SESSION['user_id']));
$coms = $stmcom->fetchAll(PDO::FETCH_GROUP);
// var_dump("rows_posts");
// var_dump($rows_posts);
// var_dump("coms");

// var_dump($coms);
// !-------------renderHTML/liked_text_boxを編集
$stat = $db->prepare("SELECT pid FROM posts WHERE ( uid = ? OR `uid` IN (SELECT followed_uid FROM followed WHERE uid = ? ))");
$stat->execute(array($_SESSION['user_id'] , $_SESSION['user_id']));
$rows_pid = $stat->fetchAll(PDO::FETCH_COLUMN); // SELECT結果を配列に格納
// var_dump($rows_pid);
if(count($rows_pid) >1){
// !rows_global_like
$in  = str_repeat('?,', count($rows_pid) - 1) . '?';
$sql_1 = "SELECT pid , uid , t.* FROM thumbup t WHERE pid IN ($in) ORDER BY `add_time` DESC ";
$stm = $db->prepare($sql_1);
$stm->execute($rows_pid);
$rows_like = $stm->fetchAll(PDO::FETCH_GROUP);
// var_dump($rows_like);
// !rows_global_like_count
$sql_2 = "SELECT pid, count(*) FROM thumbup  WHERE pid IN ($in) GROUP BY pid";
$stm = $db->prepare($sql_2);
$stm->execute( $rows_pid);
$count_rows = $stm->fetchAll(PDO::FETCH_KEY_PAIR);
// var_dump($count_rows);
// !rows_self_like
$sql_3 = "SELECT pid , t.* FROM thumbup t WHERE pid IN ($in) AND uid = ? ORDER BY `add_time` DESC ";
$stm = $db->prepare($sql_3);
$stm->execute( array_merge(
  $rows_pid , 
  [$_SESSION['user_id']]
  ) );
$rows_self_like = $stm->fetchAll(PDO::FETCH_UNIQUE);
// var_dump($rows_self_like);

}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/commen.css" />
  <link rel="stylesheet" href="css/main.css" />
  <script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
  <script src="js/main.js"></script>
  <title>main page</title>
</head>

<body>
  <div class="wrap">
    <nav>
      <?php require "nav.html"; ?>
    </nav>
    <main>

      <div class="container">

        <div class="left">
          <div class="left_box">
            <p class="spaceholder1"></p>

            <?php if (count(@$rows_posts) == 0): ?>
            <article>
              <section class="main">
                <p>誰もフォローしていないようです。</p>
                <p>seems you don't hava any followed user , let's add someone first.</p>
              </section>
            </article>
            <?php endif; ?>

            <?php foreach ($rows_posts as $row_posts):  
              
              //! -     --$like_flag
              // $sql_3 = "SELECT pid , t.* FROM thumbup t WHERE pid = ? AND uid = ? ORDER BY `add_time` DESC ";
              // $stm = $db->prepare($sql_3);
              // $stm->execute( array(
              //   $row_posts['pid'] , 
              //   $_SESSION['user_id']
              //   ) );
              // $row_like = $stm->fetchAll();
              // // var_dump($row_like);

              //   if(count($row_like) > 0){
              //     $like_flag = true;
              //   } else if(count($row_like) ==0 ){
              //     $like_flag = false;
              //   }

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
                <i class="<?=isset($rows_self_like[$row_posts['pid']]) ? 'fas' : 'far' ; ?> fa-heart fa-2x fa-fw"
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

            <article class="load_more">load more</article>
          </div>
        </div>
        <div class="right">
          <div class="aside">
            <article class="show_self">
              <section class="show_user header">
                <img src="./images/user/<?=$rows_user[$_SESSION['user_id']]['picture'] ; ?>" alt="">
                <span><?=$row_user["name"]; ?></span>
              </section>
            </article>

            <article class="show_users">
              <?php foreach ($rows_user as $row_user): ?>
              <div class="show_user header">
                <img src="./images/user/<?=$row_user["picture"]; ?>" alt="">
                <span><?=$row_user["name"]; ?></span>
                <form action="" method="post">
                  <button type="submit" name="<?=isset($rows_fol[$row_user["uid"]]) ? 'unfollowSb' : 'followSb' ; ?>" value="<?=$row_user["uid"]; ?>">
                    <i class="fas <?=isset($rows_fol[$row_user["uid"]]) ? 'fa-user-minus' : 'fa-user-plus' ; ?> fa-2x fa-fw" title="follow"></i>
                  </button>
                </form>
              </div>
              <?php endforeach; ?>
            </article>
            <article class="footer">
              <footer>
                WEIJ no &copy; copyright, only use for study purpose.
              </footer>
            </article>
          </div>


        </div>
      </div>
    </main>
  </div>


  <div id="gotop">
    <div class="arrow"></div>
    <div class="stick"></div>
  </div>
  <script>
    $(function () {

      $(window).scroll(function () {  //只要窗口滚动,就触发下面代码

        var scrollt = document.documentElement.scrollTop + document.body.scrollTop; //获取滚动后的高度

        if (scrollt > 200) {  //判断滚动后高度超过200px,就显示

          $("#gotop").fadeIn(400); //淡入

        } else {

          $("#gotop").stop().fadeOut(400); //如果返回或者没有超过,就淡出.必须加上stop()停止之前动画,否则会出现闪动

        }

      });

      $("#gotop").click(function () { //当点击标签的时候,使用animate在200毫秒的时间内,滚到顶部

        $("html,body").animate({ scrollTop: "0px" }, 200);

      });

    });



  </script>
</body>

</html>