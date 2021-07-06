<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['board_username'])) {
    $username = $_SESSION['board_username'];
    $user = get_user_from_username($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $limit = 10;
  $offset = ($page - 1) * $limit;

  $stmt = $conn->prepare("SELECT * FROM keke_comments JOIN keke_users ON keke_comments.username = keke_users.username WHERE is_deleted = 'N' ORDER BY created_time DESC LIMIT ? OFFSET ?;");
  $stmt->bind_param('ii', $limit, $offset);

  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }
  $result = $stmt->get_result();

  $count_stmt = $conn->prepare("SELECT count(*) AS count FROM keke_comments JOIN keke_users ON keke_comments.username = keke_users.username WHERE is_deleted = 'N' ORDER BY created_time DESC;");
  $count_result = $count_stmt->execute();
  if (!$count_result) {
    die('Error: ' . $conn->error);
  }

  $count_result = $count_stmt->get_result();
  $count_row = $count_result->fetch_assoc();
  $count = $count_row['count'];
  $total_page = ceil($count / $limit);  

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
      <?php if ($user && $user['role_id'] === 1) { ?>
        <a href="admin.php" class="board__btn">Admin</a>
      <?php } ?>
      <?php if (!$username) { ?>
        <a href="register.php" class="board__btn">Register</a>
        <a href="login.php" class="board__btn">Login</a>
      <?php } else {?>
        <a href="logout.php" class="board__btn">Logout</a>
        <span class="board__btn btn__edit-nickname">Edit Nickname</span>
        <form class="hide board__nickname-form" method="POST" action="handle_edit_user-nickname.php">
          <div class="board__form-item">
            <span>New nickname: </span><input name="nickname" />
          </div>
          <input type="submit" value="Submit" class="board__submit-btn" />
        </form>
        <div class="board__greeting">Hello, <?php echo escape($user['nickname']); ?>! How are you today?</div>
      <?php } ?>
    </div>
    <h1 class="board__title">Comments</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $errorMsg = "Error!";
        if ($code === '1') {
          $errorMsg = "data incomplete!";
        } else if ($code === '2') {
          $errorMsg = "you can't delete other's comment!";
        } else if ($code === '3') {
          $errorMsg = "access denied!";
        } else if ($code === '4') {
          $errorMsg = "database error. Please try again.";
        } else if ($code === '5') {
          $errorMsg = "data can't include space only";
        } 
        echo '<span class="board__error">Error: ' . escape($errorMsg) . '</span>';
      }
    ?>
    
    <?php if (!$username) { ?>
      <h3>Please login to post!</h3>
    <?php } else if ($user['role_id'] !== 1 && $user['role_id'] !== 2) { ?>
      <h3>You don't have the access to post new comments!</h3>
    <?php } else { ?>
      <form class="board__new-comment-form" method="POST" action="handle_add_comment.php" >
        <textarea name="content" placeholder="Share your thoughts!" class="board__input"></textarea> 
        <input type="submit" value="Submit" class="board__submit-btn"/>
      </form>
    <?php } ?>
    
    <div class="board__hr"></div>
    <section class="comments">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="comment">
          <div class="comment__avatar"><?php echo escape($row['nickname'][0]); ?></div>
          <div class="comment__body">
            <div class="comment__info">
              <span class="comment__user"><?php echo escape($row['nickname']) . " "; ?></span>
              <span class="comment__user">(@<?php echo escape($row['username']); ?>) </span>
              <span> | </span>
              <span class="comment__time"><?php echo escape($row['created_time']); ?></span>
              <?php if ($row['username'] === $username || ($username && $user['role_id'] === 1)) { ?>
                <a href="edit_comment.php?comment_id=<?php echo escape($row['comment_id']); ?>" class="btn__action">Edit</a>
                <a href="handle_delete_comment.php?comment_id=<?php echo escape($row['comment_id']); ?>" class="btn__action">Delete</a>
              <?php } ?>
            </div>
            <div class="comment__content"><?php echo escape($row['content']); ?></div>
          </div>
        </div>
      <?php } ?>
    </section>
    <div class="board__hr"></div>
    <div class="board__bottom">
      <div class="page-info">
        <span>Total <?php echo escape($count); ?> comments. Page: <?php echo escape($page); ?> / <?php echo escape($total_page); ?></span>
      </div>
      <div class="paginator">
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
          <a href="index.php?page=<?php echo escape($i); ?>"><?php echo escape($i) ?></a>
        <?php } ?>
      </div>
    </div>
  </main>

  <script>
    document.querySelector(".btn__edit-nickname").addEventListener("click", (e) => {
      document.querySelector(".board__nickname-form").classList.toggle("hide")
    })
  </script>
</body>
</html>