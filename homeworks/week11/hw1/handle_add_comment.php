<?php
  session_start();
  require_once("conn.php");

  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die("Data incomplete!");
  }

  $username = $_SESSION['username'];
  $content = $_POST['content'];

  $sql = "INSERT INTO keke_comments (username, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);

  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");

?>