<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_GET['comment_id'])) {
    header("Location: index.php?errCode=1");
    die("Data incomplete!");
  }

  if (!$_SESSION['username']) {
    header("Location: index.php?errCode=2");
    exit();
  }

  $username = $_SESSION['username'];
  $user = get_user_from_username($username);
  $comment_id = $_GET['comment_id'];

  $query_sql = "SELECT * FROM keke_comments WHERE comment_id = ?";
  $query_stmt = $conn->prepare($query_sql);
  $query_stmt->bind_param('i', $comment_id);

  $query_result = $query_stmt->execute();

  if (!$query_result) {
    die($conn->error);
  }

  $query_result = $query_stmt->get_result();
  $row = $query_result->fetch_assoc();
  if ($username !== $row['username'] && $user['role_id'] !== 1) {
    header("Location: index.php?errCode=2");
    exit();
  }
    
  $sql = "UPDATE keke_comments SET is_deleted = 'Y' WHERE comment_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $comment_id);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");

?>