<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die("Data incomplete!");
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $nickname = $user['nickname'];
  $content = $_POST['content'];

  $sql = sprintf("INSERT INTO keke_comments (nickname, content) VALUES ('%s','%s')", $nickname, $content);
  $result = $conn->query($sql);

  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");

?>