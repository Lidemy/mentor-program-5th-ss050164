<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $stmt = $conn->prepare("SELECT category, COUNT(*) AS count FROM keke_articles WHERE is_deleted = 'N' GROUP BY category ORDER BY category ASC;");
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
          <div class="section__title">View Categories</div>
          <?php
            if (!empty($_GET['errCode'])) {
              $code = $_GET['errCode'];
              $errorMsg = "Error!";
              if ($code === '1') {
                $errorMsg = "invalid category!";
              } 
              echo '<span class="blog__error">Error: ' . escape($errorMsg) . '</span>';
            }
          ?>
        </div>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="article category">
            <div class="article__head">
              <div class="article__category-title">
                <a href="list_articles_by_category.php?category=<?php echo escape($row['category']); ?>"><?php echo escape($row['category']); ?></a>
                <span class="article__category-count">(<?php echo escape($row['count']); ?>)</span>
              </div>            
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