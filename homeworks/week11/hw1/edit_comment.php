<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $comment_id = $_GET['comment_id'];

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = get_user_from_username($username);
  }

  $stmt = $conn->prepare("SELECT * FROM keke_comments WHERE comment_id = ? AND is_deleted = 'N';");
  $stmt->bind_param('i', $comment_id);

  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Comments</title>
  <link rel="stylesheet" href=".\normalize.css">
  <link rel="stylesheet" href=".\style.css">
</head>
<body>
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <main class="board">
    <div>
      <a href="index.php" class="board__btn">Board</a>
      <?php if (!$username) { ?>
        <a href="login.php" class=board__btn>Login</a>
      <?php } else { ?>
        <a href="logout.php" class=board__btn>Logout</a>
      <?php } ?>
    </div>
    <h1 class="board__title">Edit Comments</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $errorMsg = "Error!";
        if ($code === '1') {
          $errorMsg = "data incomplete!";
        }
        echo '<span class="board__error">Error: ' . escape($errorMsg) . '</span>';
      }
    ?>

    <?php if (!$username) { ?>
      <div>Hello, guest, please login to edit.</div>
    <?php } else if (!$row) { ?>
      <div>Invalid comment id.</div>
    <?php } else if ($username === $row['username'] || ($username && $user['role_id'] === 1)) { ?>
      <form class="board__edit-comment-form" method="POST" action="handle_edit_comment.php">      
        <textarea name="content" class="board__input"><?php echo escape($row['content']); ?></textarea>
        <input type="hidden" name="comment_id" value="<?php echo escape($row['comment_id']); ?>" />
        <input type="submit" value="Submit" class="board__submit-btn" />
      </form>
    <?php } else { ?>
      <div>You can't edit other's comment.</div>
    <?php } ?>
  </main>

</body>
</html>