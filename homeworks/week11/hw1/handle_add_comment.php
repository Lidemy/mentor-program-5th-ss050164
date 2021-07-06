<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!$_SESSION['board_username']) {
    header("Location: index.php?errCode=3");
    die(); // Access denied
  }

  $username = $_SESSION['board_username'];
  $user = get_user_from_username($username);
  if ($user['role_id'] === 3) {
    header("Location: index.php?errCode=3");
    die(); // Access denied
  }
  
  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die(); // Data incomplete
  }
  
  if (strlen(trim($_POST['content'])) === 0) {
    header("Location: index.php?errCode=5");
    die(); // user enters space only
  }

  $content = $_POST['content'];

  $sql = "INSERT INTO keke_comments (username, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);

  $result = $stmt->execute();
  if (!$result) {
    header("Location: index.php?errCode=4");
    die(); // database error
  }

  header("Location: index.php");

?>