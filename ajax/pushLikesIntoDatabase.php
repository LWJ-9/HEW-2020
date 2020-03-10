<?php 
require_once "../system/common_admin.php";

// var_dump(  $_REQUEST);

// !-------------Likes/thumbup/いいね+++ 追加
if(isset($_REQUEST['pid'])  && $_REQUEST['act'] == 'add'  ){
  $stm = $db->prepare("SELECT * FROM thumbup WHERE uid = ? AND pid = ?");
  $stm->execute( array( $_SESSION['user_id'] , $_REQUEST['pid'] ));
  $row_like = $stm->fetch();
  if(!$row_like) {
    $statement = $db->prepare("INSERT INTO  thumbup (`uid`, `pid`) VALUES (?, ?)");
    $statement->execute(
      array(
        $_SESSION['user_id'] ,
        $_REQUEST['pid'] 
        )
    );
  }
}

// !-------------remove-Likes/thumbup いいね-削除
if(isset($_REQUEST['pid'])  && $_REQUEST['act'] == 'remove'  ){
  $stm = $db->prepare("SELECT * FROM thumbup WHERE uid = ? AND pid = ?");
  $stm->execute( array( $_SESSION['user_id'] , $_REQUEST['pid'] ));
  $row_like = $stm->fetch();
  if($row_like) {
    $statement = $db->prepare("DELETE FROM thumbup WHERE `uid`=? AND `pid`=?");
    $statement->execute(
      array(
        $_SESSION['user_id'] ,
        $_REQUEST['pid'] 
        )
    );
  }
}

// !-------------renderHTML/liked_text_boxを編集
$stm = $db->prepare("SELECT u.uid , u.name FROM thumbup t INNER JOIN users u ON t.uid = u.uid WHERE pid = ? ORDER BY t.`add_time` DESC LIMIT 1");
$stm->execute( array($_REQUEST['pid'] ));
$row_like = $stm->fetch(PDO::FETCH_ASSOC);
// var_dump($row_like);

$stm = $db->prepare("SELECT count(*) FROM thumbup WHERE pid = ?");
$stm->execute( array($_REQUEST['pid'] ));
$count_rows = $stm->fetch(PDO::FETCH_COLUMN);
?>

<p class="liked_text_box">
  <?php if($row_like): ?>
                  Liked by
                  <a class="" title="<?=$row_like['name'];?>" href="./user.php?uid=<?=$row_like['uid'];?>">
                    <?=$row_like['name'];?>
                  </a><?php if($count_rows != 1): ?>
                  and <span><?=$count_rows-1;?></span> others<?php endif; ?>
  <?php endif; ?>
  <?php if(!$row_like): ?>
                  no one pushed the like button yet.
  <?php endif; ?>
                </p>