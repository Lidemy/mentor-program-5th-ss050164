<?php
  session_start();
  require_once("conn.php");

  if (empty($_POST['title']) || empty($_POST['category']) || empty($_POST['content'])) {
    header("Location: post_article.php?errCode=1");
    die(); // Data incomplete!
  }

  echo trim($_POST['title']);

  if (strlen(trim($_POST['title'])) === 0 || strlen(trim($_POST['category'])) === 0 || strlen(trim($_POST['content'])) === 0) {
    header("Location: post_article.php?errCode=2");
    die();
  }

  $title = trim($_POST['title']);
  $category = trim($_POST['category']);
  $content = trim($_POST['content']);

  $sql = "INSERT INTO keke_articles (title, category, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $title, $category, $content);

  $result = $stmt->execute();
  if (!$result) {
    header("Location: post_article.php&errCode=3");
    die();
  }

  header("Location: index.php");

?>