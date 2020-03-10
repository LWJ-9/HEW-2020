<?php require_once "./system/common_admin.php";?>
<?php
if (isset($_REQUEST['liked'])) {
  $stm = $db->prepare("SELECT * FROM thumbup t join posts p ON t.pid = p.pid WHERE t.uid = ? AND p.status = 1");
  $stm->execute([$_SESSION['user_id']]);
  $rows_liked = $stm->fetchAll();
  // var_dump($rows_liked);
  $rows = $rows_liked;
}
if (isset($_REQUEST['global'])) {
  $stm = $db->prepare("SELECT * FROM  posts WHERE status = 1");
  $stm->execute();
  $rows_global = $stm->fetchAll();
  // var_dump($rows_global);
  $rows = $rows_global;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/commen.css" />
  <link rel="stylesheet" href="css/search.css" />
  <title>liked posts page</title>
</head>

<body>
  <div class="wrap">
    <nav>
      <?php require "nav.html"; ?>
    </nav>
    <main>
      <?php if (count($rows) == 0): ?>
      <div class="no_keyword">
        <p>no result found</p>
      </div>
      <?php endif; ?>

      <?php if (isset($rows)): ?>

      <div class="content <?= isset($_REQUEST['liked']) ? 'liked' : ( isset($_REQUEST['global']) ? 'global' : null ) ;?>">
        <?php foreach($rows as $row)         : ?>
        <div class="item" onclick="location = 'post.php?pid=<?=$row['pid']; ?>'"
          style="background: url('<?='images/posts/' . $row['media'] ;?>') no-repeat; background-size: cover;">
          <img src="" alt="">
          <p>
            <?=htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </main>
    <footer hidden>
      footer
    </footer>
  </div>
  <script>
    if(document.querySelector('.liked')){
      item = document.querySelector('.topRightBtnHolder i.fa-heart');
      item.classList.remove('far');
      item.classList.add('fas');
    }
    if(document.querySelector('.global')){
      item = document.querySelector('.topRightBtnHolder i.fa-compass');
      item.classList.remove('far');
      item.classList.add('fas');
    }
  </script>
</body>

</html>