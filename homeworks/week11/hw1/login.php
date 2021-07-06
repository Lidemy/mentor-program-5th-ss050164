<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  $nickname = NULL;
  if (!empty($_SESSION['board_username'])) {
    $username = $_SESSION['board_username'];
    $user = get_user_from_username($username);
    $nickname = $user['nickname'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Board-Login</title>
  <link rel="stylesheet" href="normalize.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <main class="board">
    <div>
      <a href="index.php" class="board__btn">Board</a>
      <?php if (!$username) { ?>
        <a href="register.php" class=board__btn>Register</a>
      <?php } else { ?>
        <a href="logout.php" class=board__btn>Logout</a>
      <?php } ?>
    </div>
    <h1 class="board__title">Login</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = ($_GET['errCode']);
        $errorMsg = 'Error!';
        if ($code === '1') {
          $errorMsg = 'data incomplete!';
        } else if ($code === '2') {
          $errorMsg = 'wrong username or password!';
        } else if ($code === '3') {
          $errorMsg = "database error. Please try again.";
        }
        echo '<span class="board__error">Error: ' . escape($errorMsg) . '</span>';
      }
    ?>
    <?php if(!$username) { ?>
      <form class="board__login-form" method="POST" action="handle_login.php">
        <div class="board__form-item">
          <span>Username:</span><input name="username" />
        </div>
        <div class="board__form-item">
          <span>Password: </span><input type="password" name="password" />
        </div>
        <input type="submit" value="Submit" class="board__submit-btn" />
      </form>
    <?php } else { ?>
      <div>Hi, <?php echo escape($nickname); ?>, you have already logged in!</div>
    <?php } ?>

  </main>
  
</body>
</html>