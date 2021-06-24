<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (empty($_SESSION['b_username'])) {
    header("Location: index.php?errCode=1");
    die("Access denied");
  }

  $username = $_SESSION['b_username'];

  $stmt = $conn->prepare("SELECT * FROM keke_articles WHERE is_deleted = 'N' ORDER BY created_time DESC;");
  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }

  $result = $stmt->get_result();

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
          <div class="section__title">Admin</div>
        </div>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="article admin">
            <div class="article__head">
              <div class="article__title">
                <a href="view_article.php?article_id=<?php echo escape($row['article_id']); ?>"><?php echo escape($row['title']); ?></a>
              </div>
            </div>
            <div class="article__info admin">            
              <span class="article__time"><?php echo escape($row['created_time']); ?></span>
              <a href="edit_article.php?article_id=<?php echo escape($row['article_id']); ?>" class="article__edit-btn">Edit</a>
              <a href="handle_delete_article.php?article_id=<?php echo escape($row['article_id']); ?>" class="article__edit-btn">Delete</a>
            </div>
          </div>
        <?php } ?>
      </section>
    </div>
  </main>

  <footer>Copyright © 2021 My Blog All Rights Reserved.</footer>

  <script>
    
  </script>
</body>
</html>