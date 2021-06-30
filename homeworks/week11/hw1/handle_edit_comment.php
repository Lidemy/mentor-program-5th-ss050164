<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die(); // Data incomplete
  }

  $username = $_SESSION['board_username'];
  $content = $_POST['content'];
  $comment_id = $_POST['comment_id'];  
  
  $sql = "UPDATE keke_comments SET content = ? WHERE comment_id = ? AND is_deleted = 'N'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $content, $comment_id);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    header("Location: index.php?errCode=4");
    die(); // database error
  }

  header("Location: index.php");

?>