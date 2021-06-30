<?php
  require_once("conn.php");
  
  function get_user_from_username($username) {
    global $conn;

    $user_sql = "SELECT * FROM keke_blog_users WHERE username = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param('s', $username);

    $user_result = $user_stmt->execute();
    if (!$user_result) {
      die($conn->error);
    }

    $user_result = $user_stmt->get_result();
    $row = $user_result->fetch_assoc();

    return $row;
  }

  function get_article_from_article_id($article_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM keke_articles WHERE article_id = ? AND is_deleted = 'N';");
    $stmt->bind_param('i', $article_id);

    $result = $stmt->execute();
    if (!$result) {
      die('Error: ' . $conn->error);
    }

    $result = $stmt->get_result();
    
    return $result;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

?>