<?php
  require_once("conn.php");

  if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: register.php?errCode=1");
    die("Data incomplete!");
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf("INSERT INTO keke_users (nickname, username, password) VALUES ('%s','%s', '%s')", $nickname, $username, $password);
  $result = $conn->query($sql);

  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header("Location: register.php?errCode=2");
    }
    die($conn->error);
  }

  session_start();
  $_SESSION['username'] = $username;
  header("Location: index.php");

?>