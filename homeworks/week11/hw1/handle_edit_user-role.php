<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_POST['role_id'])) {
    header("Location: admin.php?errCode=1");
    die();
  }

  $role_id = intval($_POST['role_id']);
  if ($role_id === 1) {
    header("Location: admin.php?errCode=2");
    die();
  }
  if ($role_id !== 2 && $role_id !== 3) {
    header("Location: admin.php?errCode=3");
    die();
  }

  $username = $_POST['username'];

  $sql = "UPDATE keke_users SET role_id = ? WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $role_id, $username);
  
  $result = $stmt->execute();  // 儲存執行或失敗
  if (!$result) {
    die($conn->error);
  }

  header("Location: admin.php");

?>