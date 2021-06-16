<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $nickname = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = get_user_from_username($username);
    $nickname = $user['nickname'];
  }

  $result = $conn->query("SELECT * FROM keke_comments ORDER BY created_time DESC;");
  if (!$result) {
    die('Error: ' . $conn->error);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Board</title>
  <link rel="stylesheet" href=".\normalize.css">
  <link rel="stylesheet" href=".\style.css">
</head>
<body>
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <main class="board">
    <div>
      <?php if (!$username) { ?>
        <a href="register.php" class="board__btn">Register</a>
        <a href="login.php" class=board__btn>Login</a>
      <?php } else {?>
        <a href="logout.php" class=board__btn>Logout</a>
        <span class="board__greeting">Hello, <?php echo $nickname; ?>! How are you today?</span>
      <?php } ?>
    </div>
    <h1 class="board__title">Comments</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $errorMsg = "Error!";
        if ($code === '1') {
          $errorMsg = "data incomplete!";
        }
        echo '<span class="board__error">Error: ' . $errorMsg . '</span>';
      }

    ?>
    <form class="board__new-comment-form" method="POST" action="handle_add_comment.php" >
      <textarea name="content" placeholder="Share your thoughts!" class="board__input"></textarea>
      
      <?php if ($username) { ?>
        <input type="submit" value="Submit" class="board__submit-btn"/>
      <?php } else { ?>
        <h3>Please login to post!</h3>
      <?php } ?>
    </form>
    <div class="board__hr"></div>

    <section class="comments">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="comment">
          <div class="comment__avatar"><?php echo $row['nickname'][0]; ?></div>
          <div class="comment__body">
            <div class="comment__info">
              <span class="comment__user"><?php echo $row['nickname']; ?></span>
              <span> | </span>
              <span class="comment__time"><?php echo $row['created_time']; ?></span>
            </div>
            <div class="comment__content"><?php echo $row['content']; ?></div>
          </div>
        </div>
      <?php } ?>
    </section>

  </main>  
</body>
</html>