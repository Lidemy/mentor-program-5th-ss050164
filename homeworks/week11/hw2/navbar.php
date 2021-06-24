<nav class="navbar">
    <div class="wrapper">
      <div class="navbar__left">
        <div class="navbar__site-name">
          <a href="index.php">My Blog</a>
        </div>
        <ul class="navbar__list">
          <li><a href="list_articles.php">Articles</a></li>
          <li><a href="list_categories.php">Categories</a></li>
        </ul>
      </div>
      <div class="navbar__right">
        <ul class="navbar__list">
          <?php if ($username) { ?>
            <li><a href="post_article.php">Post</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php } else { ?>
            <li><a href="login.php">Login</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>