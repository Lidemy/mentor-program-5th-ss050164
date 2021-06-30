<?php
  require_once("conn.php");
  session_start();

  if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: register.php?errCode=1");
    die(); // Data incomplete!
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO keke_users (nickname, username, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $username, $password);
  
  $result = $stmt->execute();
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header("Location: register.php?errCode=2");
    }
    header("Location: register.php?errCode=3");
    die(); // database error
  }

  $_SESSION['board_username'] = $username;
  header("Location: index.php");

?>