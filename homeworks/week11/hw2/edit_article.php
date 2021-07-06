<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (empty($_SESSION['b_username'])) {
    header("Location: index.php?errCode=1");
    die(); // Access denied
  }
  $username = $_SESSION['b_username'];

  $article_id = intval($_GET['article_id']);
  $result = get_article_from_article_id($article_id);
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
  <script src=".\ckeditor5-build-classic\ckeditor.js"></script>

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
            <div class="article__title">Edit article</div>
            <?php
              if (!empty($_GET['errCode'])) {
                $code = $_GET['errCode'];
                $errorMsg = "Error!";
                if ($code === '1') {
                  $errorMsg = "data incomplete!";
                } else if ($code === '2') {
                  $errorMsg = "only spaces in data.";
                } else if ($code === '3') {
                  $errorMsg = "database error. Please try again!";
                } 
                echo '<span class="blog__error">Error: ' . escape($errorMsg) . '</span>';
              }
            ?>
          </div>
          <?php if (!$row) { ?>
            <div>Invalid article id.</div>
          <?php } else { ?>     
            <form class="blog__edit-article-form" method="POST" action="handle_edit_article.php" >
              <input type="text" name="title" placeholder="Title (required)" value="<?php echo escape($row['title']); ?>" class="blog__input"/>
              <input type="text" name="category" placeholder="Category (required)" value="<?php echo escape($row['category']); ?>" class="blog__input"/>
              <textarea name="content" id="content" placeholder="What's on your mind?" class="blog__textarea"><?php echo escape($row['content']); ?></textarea>
              <input type="hidden" name="article_id" value="<?php echo escape($row['article_id']); ?>" />           
              <input type="submit" value="Submit" class="blog__submit-btn"/>
            </form>
          <?php } ?>
        </div>
      </section>
    </div>
  </main>

  <footer>Copyright © 2021 My Blog All Rights Reserved.</footer>

  <script>
    ClassicEditor
      .create( document.querySelector( '#content' ) )
      .catch( error => {
          console.error( error );
      } );

  </script>
</body>
</html>