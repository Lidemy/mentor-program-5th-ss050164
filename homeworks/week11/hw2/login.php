<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    header("Location: index.php");
    die();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog-Login</title>
  <link rel="stylesheet" href="normalize.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <main class="blog__login">
    <div>
      <a href="index.php" class="blog__btn">Blog</a>
    </div>
    <div class="blog__head">
      <h1 class="blog__title">Login</h1>
      <?php
        if (!empty($_GET['errCode'])) {
          $code = ($_GET['errCode']);
          $errorMsg = 'Error!';
          if ($code === '1') {
            $errorMsg = 'data incomplete!';
          } else if ($code === '2') {
            $errorMsg = 'wrong username or password!';
          }
          echo '<span class="blog__error">Error: ' . escape($errorMsg) . '</span>';
        }
      ?>
    </div>
    <form class="blog__login-form" method="POST" action="handle_login.php">
      <div class="blog__login-item">
        <div>Username</div>
        <input type="text" name="username" />
      </div>
      <div class="blog__login-item">
        <div>Password </div>
        <input type="password" name="password" />
      </div>
      <input type="submit" value="Submit" class="blog__submit-btn" />
    </form>


  </main>
  
</body>
</html>