<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['b_username'])) {
    $username = $_SESSION['b_username'];
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $limit = 5;
  $offset = ($page - 1) * $limit;

  $stmt = $conn->prepare("SELECT * FROM keke_articles WHERE is_deleted = 'N' ORDER BY created_time DESC LIMIT ? OFFSET ?;");
  $stmt->bind_param('ii', $limit, $offset);

  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }
  $result = $stmt->get_result();

  $count_stmt = $conn->prepare("SELECT count(*) AS count FROM keke_articles WHERE is_deleted = 'N' ORDER BY created_time DESC;");
  $count_result = $count_stmt->execute();
  if (!$count_result) {
    die('Error: ' . $conn->error);
  }

  $count_result = $count_stmt->get_result();
  $count_row = $count_result->fetch_assoc();
  $count = $count_row['count'];
  $total_page = ceil($count / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href=".\normalize.css">
  <link rel="stylesheet" href=".\style.css">
</head>
<body>
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <?php require_once('navbar.php') ?>
  <main>
    <div class="articles__wrapper">
      <section class="articles">
        <div class="section__head">
          <div class="section__title">List all articles</div>
          <?php
            if (!empty($_GET['errCode'])) {
              $code = $_GET['errCode'];
              $errorMsg = "Error!";
              if ($code === '1') {
                $errorMsg = "access denied!";
              } else if ($code === '2') {
                $errorMsg = "invalid article id!";
              } 
              echo '<span class="blog__error">Error: ' . escape($errorMsg) . '</span>';
            }
          ?>
        </div>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="article hide">
            <div class="article__head">
              <div class="article__title">
                <a href="view_article.php?article_id=<?php echo escape($row['article_id']); ?>"><?php echo escape($row['title']); ?></a>
              </div>
              <?php if ($username) { ?>
                <a href="edit_article.php?article_id=<?php echo escape($row['article_id']); ?>" class="article__edit-btn">Edit</a>
              <?php } ?>
            </div>
            <div class="article__info">
              <span class="article__time"><?php echo escape($row['created_time']); ?></span>
              <span class="article__category">
                <a href="list_articles_by_category.php?category=<?php echo escape($row['category']); ?>"><?php echo escape($row['category']); ?></a>
              </span>
            </div>
            <div class="article__body">
              <div class="article__content partial"><?php echo mb_substr($row['content'], 0, 200, "utf-8"); ?></div>
              <div class="article__content full"><?php echo $row['content']; ?></div>
            </div>
            <div class="article__bottom">
              <span class="article__read-btn">READ MORE</span>
            </div>
          </div>
        <?php } ?>
        <div class="blog__bottom">
          <div class="page-info">
            <span>Total <?php echo escape($count); ?> articles. Page: <?php echo escape($page); ?> / <?php echo escape($total_page); ?></span>
          </div>
          <div class="paginator">
            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
              <a href="list_articles.php?page=<?php echo escape($i); ?>"><?php echo escape($i) ?></a>
            <?php } ?>
          </div>
        </div>        
      </section>
    </div>  
  </main>
  <footer>Copyright © 2021 My Blog All Rights Reserved.</footer>

  <script src="utils.js"></script>

</body>
</html>