<?php
  require_once("conn.php");
  
  function getUserFromUsername($username) {
    global $conn;

    $user_sql = sprintf("SELECT * FROM keke_users WHERE username = '%s'", $username);
    $user_result = $conn->query($user_sql);
    $row = $user_result->fetch_assoc();

    return $row;
  }

?>