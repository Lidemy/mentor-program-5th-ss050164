<?php
  require_once("conn.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');


  if (empty($_GET['site_key'])) {
    get_add_comment_result(false, "Please input site key.");
    die();
  }

  $site_key = $_GET['site_key'];

  $limit = NULL;
  $stmt = NULL;
  if (!empty($_GET['limit'])) {
    $limit = $_GET['limit'];
    $stmt = $conn->prepare("SELECT * FROM keke_posts WHERE site_key = ? ORDER BY post_id DESC LIMIT ?;");
    $stmt->bind_param('si', $site_key, $limit);
  } else {
    $stmt = $conn->prepare("SELECT * FROM keke_posts WHERE site_key = ? ORDER BY post_id DESC;");
    $stmt->bind_param('s', $site_key);
  }

  $result = $stmt->execute();
  if (!$result) {
    get_add_comment_result(false, $conn->error);
    die();
  }

  $result = $stmt->get_result();
  $comments = array();
  while ($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "post_id" => $row['post_id'],
      "site_post_id" => $row['site_post_id'],
      "nickname" => $row['nickname'],
      "content" => $row['content'],
      "created_time" => $row['created_time']
    ));
  }

  $json = array(
    "is_success" => true,
    "comments" => $comments
  );

  $response = json_encode($json);
  echo $response;

?>