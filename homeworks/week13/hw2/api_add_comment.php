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

  $count_sql = "SELECT count(*) AS count FROM keke_posts WHERE site_key = ?";
  $count_stmt = $conn->prepare($count_sql);
  $count_stmt->bind_param('s', $site_key);
  
  $count_result = $count_stmt->execute();
  if (!$count_result) {
    get_add_comment_result(false, $conn->error);
    die();
  }

  $count_result = $count_stmt->get_result();
  $count_row = $count_result->fetch_assoc();
  $count = intval($count_row['count']);

  $site_post_id = $count + 1;

  $sql = "INSERT INTO keke_posts (nickname, content, site_key, site_post_id) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sssi', $nickname, $content, $site_key, $site_post_id);

  $result = $stmt->execute();
  if (!$result) {
    get_add_comment_result(false, $conn->error);
    die();
  }

  get_add_comment_result(true, "Success!"); 

?>