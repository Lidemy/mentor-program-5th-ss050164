<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (!$_SESSION['username']) {
    header("Location: index.php?errCode=1");
    exit();
  }

  if (empty($_GET['article_id'])) {
    header("Location: index.php?errCode=2");
    die("Data incomplete!");
  }

  $article_id = $_GET['article_id'];

  $sql = "UPDATE keke_articles SET is_deleted = 'Y' WHERE article_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $article_id);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    die($conn->error);
  }

  header("Location: admin.php");

?>