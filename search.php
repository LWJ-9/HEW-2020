<?php require_once "./system/common_admin.php";?>
<?php
if (isset($_GET['search'])) {
  $stm = $db->prepare("SELECT * FROM posts WHERE text REGEXP ? OR pid IN( 
    SELECT p.pid FROM posts p JOIN comments c ON p.pid = c.pid WHERE c.content REGEXP ? )");
  // var_dump($_GET['search']);
  $split = explode(' ', $_GET['search']);
  // var_dump($split);
  $join = join('|', $split);
  // var_dump($join);
  // $search = "%".$_GET['search']."%";
  $stm->execute([$join, $join]);
  $rows_search = $stm->fetchAll();
  // var_dump($rows_search);
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
  <title>search page</title>
</head>

<body>
  <div class="wrap">
    <nav>
      <?php require "nav.html"; ?>
    </nav>
    <main>
      <?php if (count($rows_search) == 0): ?>
      <div class="no_keyword">
        <p>no result found</p>
      </div>
      <?php endif; ?>

      <?php if (isset($rows_search)): ?>

      <div class="content">
        <?php foreach($rows_search as $row_search)         : ?>
        <div class="item" onclick="location = 'post.php?pid=<?=$row_search['pid']; ?>'"
          style="background: url('<?='images/posts/' . $row_search['media'] ;?>') no-repeat; background-size: cover;">
          <img src="" alt="">
          <p>
            <?=htmlspecialchars($row_search['text'], ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </main>
    <footer>
      footer
    </footer>
  </div>
</body>

</html>