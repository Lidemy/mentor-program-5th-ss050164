<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (empty($_SESSION['username'])) {
    header("Location: index.php?errCode=1");
    die("Access denied");
  }
  $username = $_SESSION['username'];

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
            <div class="article__title">Post new article</div>
            <?php
              if (!empty($_GET['errCode'])) {
                $code = $_GET['errCode'];
                $errorMsg = "Error!";
                if ($code === '1') {
                  $errorMsg = "data incomplete!";
                } 
                echo '<span class="blog__error">Error: ' . escape($errorMsg) . '</span>';
              }
            ?>
          </div>          
          <form class="blog__new-article-form" method="POST" action="handle_post_article.php" >
            <input type="text" name="title" placeholder="Title (required)" class="blog__input"/>
            <input type="text" name="category" placeholder="Category (required)" class="blog__input"/>
            <textarea name="content" id="content" placeholder="What's on your mind?" class="blog__textarea"></textarea>            
            <input type="submit" value="Submit" class="blog__submit-btn"/>
          </form>
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