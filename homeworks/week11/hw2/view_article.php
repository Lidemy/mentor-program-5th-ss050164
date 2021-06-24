<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $article_id = NULL;
  if (!empty($_GET['article_id'])) {
    $article_id = intval($_GET['article_id']);
  }

  $result = get_article_from_article_id($article_id);
  if ($result->num_rows === 0) {
    header("Location: index.php?errCode=2");
    die("Invalid article id");
  }

  $row = $result->fetch_assoc();
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
        <div class="article">
          <div class="article__head">
            <div class="article__title"><?php echo escape($row['title']); ?></div>
            <div class="article__btn-block">
              <?php if ($username) { ?>
                <a href="edit_article.php?article_id=<?php echo escape($row['article_id']); ?>" class="article__edit-btn">Edit</a>
                <a href="handle_delete_article.php?article_id=<?php echo escape($row['article_id']); ?>" class="article__edit-btn">Delete</a>
              <?php } ?>
            </div>            
          </div>
          <div class="article__info">
            <span class="article__time"><?php echo escape($row['created_time']); ?></span>
            <span class="article__category">
              <a href="list_articles_by_category.php?category=<?php echo escape($row['category']); ?>"><?php echo escape($row['category']); ?></a>
            </span>
          </div>
          <div class="article__body">
            <div class="article__content view"><?php echo $row['content']; ?></div>
          </div>
        </div> 
      </section>
    </div>


  </main>

  <footer>Copyright © 2021 My Blog All Rights Reserved.</footer>

  <script>
    
  </script>
</body>
</html>