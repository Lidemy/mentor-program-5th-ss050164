<?php
  require_once("conn.php");
  
  function get_user_from_username($username) {
    global $conn;

    $user_sql = "SELECT * FROM keke_users WHERE username = ?";
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

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  function get_add_comment_result($is_success, $message) {
    $json = array(
      "is_success" => $is_success,
      "message" => $message
    );

    $response = json_encode($json);
    echo $response;
  }

?>