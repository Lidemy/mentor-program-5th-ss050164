<?php
  require_once("conn.php");
  require_once("utils.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');


  if (empty($_POST['nickname']) || empty($_POST['content']) || empty($_POST['site_key'])) {
    get_add_comment_result(false, "Please input content.");
    die();
  }

  $nickname = $_POST['nickname'];
  $content = $_POST['content'];
  $site_key = $_POST['site_key'];

  $sql = "INSERT INTO keke_posts (nickname, content, site_key) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $content, $site_key);

  $result = $stmt->execute();
  if (!$result) {
    get_add_comment_result(false, $conn->error);
    die();
  }

  get_add_comment_result(true, "Success!"); 

?>