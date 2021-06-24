<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_POST['nickname'])) {
    header("Location: index.php?errCode=1");
    die("Data incomplete!");
  }

  $nickname = $_POST['nickname'];
  $username = $_SESSION['username'];
  
  $sql = "UPDATE keke_users SET nickname = ? WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");

?>