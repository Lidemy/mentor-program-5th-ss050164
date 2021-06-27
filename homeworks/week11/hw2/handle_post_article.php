<?php
  session_start();
  require_once("conn.php");

  if (empty($_POST['title']) || empty($_POST['category']) || empty($_POST['content'])) {
    header("Location: post_article.php?errCode=1");
    die("Data incomplete!");
  }

  $title = $_POST['title'];
  $category = $_POST['category'];
  $content = $_POST['content'];

  $sql = "INSERT INTO keke_articles (title, category, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $title, $category, $content);

  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");

?>