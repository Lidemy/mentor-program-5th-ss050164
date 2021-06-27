<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['b_username'])) {
    $username = $_SESSION['b_username'];
  }

  $limit = 5;
  $stmt = $conn->prepare("SELECT * FROM keke_articles WHERE is_deleted = 'N' ORDER BY created_time DESC LIMIT ?;");
  $stmt->bind_param('i', $limit);

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
          <div class="section__title">Latest 5 articles</div>
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
              <div class="article__content"><?php echo $row['content']; ?></div>
            </div>
            <div class="article__bottom">
              <span class="article__read-btn">READ MORE</span>
            </div>
          </div>
        <?php } ?>
      </section>
    </div>
  </main>

  <footer>Copyright © 2021 My Blog All Rights Reserved.</footer>

  <script>
    document.querySelector(".articles").addEventListener("click", (e) => {
      if (e.target.classList.contains("article__read-btn")) {
        e.target.parentNode.parentNode.classList.toggle("hide")
        const btn = e.target.closest(".article__read-btn")

        if (!e.target.parentNode.parentNode.classList.contains("hide")) {          
          btn.innerText = "SHOW LESS"
        } else {
          btn.innerText = "READ MORE"
        }
      }
    })

  </script>
</body>
</html>