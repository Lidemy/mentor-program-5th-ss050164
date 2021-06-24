<?php
  require_once("conn.php");
  header('Content-type:application/json;charset=utf-8');

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $limit = 5;
  $offset = ($page - 1) * $limit;

  $stmt = $conn->prepare("SELECT * FROM keke_comments JOIN keke_users ON keke_comments.username = keke_users.username WHERE is_deleted IS NULL ORDER BY created_time DESC LIMIT ? OFFSET ?;");
  $stmt->bind_param('ii', $limit, $offset);

  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }

  $result = $stmt->get_result();
  $comments = array();
  while ($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "comment_id" => $row['comment_id'],
      "username" => $row['username'],
      "nickname" => $row['nickname'],
      "content" => $row['content'],
      "created_time" => $row['created_time']
    ));
  }

  $json = array("comments" => $comments);

  $response = json_encode($json);
  echo $response;

?>