<?php
  require_once("conn.php");
  require_once("utils.php");
  header('Content-type:application/json;charset=utf-8');

  if (empty($_POST['content'])) {
    get_add_comment_result(false, "Please input content.");
    die();
  }

  $username = $_POST['username'];
  $content = $_POST['content'];

  $sql = "INSERT INTO keke_comments (username, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);

  $result = $stmt->execute();
  if (!$result) {
    get_add_comment_result(false, $conn->error);
    die();
  }

  get_add_comment_result(true, "Success!"); 

?>