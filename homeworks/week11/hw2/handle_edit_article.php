<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $article_id = intval($_POST['article_id']);
  if (empty($_POST['content']) || empty($_POST['category']) || empty($_POST['title'])) {
    $location = "Location: edit_article.php?errCode=1&article_id=" . $article_id;
    header($location);
    die("Data incomplete!");
  }

  $username = $_SESSION['b_username'];
  $title = $_POST['title'];
  $category = $_POST['category'];
  $content = $_POST['content'];
  
  $sql = "UPDATE keke_articles SET title = ?, category = ?, content = ? WHERE article_id = ? AND is_deleted = 'N'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sssi', $title, $category, $content, $article_id);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    die($conn->error);
  }

  $location = "Location: view_article.php?article_id=" . $article_id;
  header($location);

?>