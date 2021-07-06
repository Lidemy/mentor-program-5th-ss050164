<?php
  require_once("conn.php");
  require_once("utils.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_GET['todolist_id'])) {
    get_todoAPI_result(false, "Please enter a todo list ID.", null);
    die();
  }

  $todolist_id = intval($_GET['todolist_id']);
  $stmt = $conn->prepare("SELECT * FROM keke_todolists WHERE todolist_id = ?;");
  $stmt->bind_param('i', $todolist_id);

  $result = $stmt->execute();
  if (!$result) {
    get_todoAPI_result(false, $conn->error, null);
    die();
  }

  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    get_todoAPI_result(false, "invalid todolist id", null);
    die();
  }
 
  $row = $result->fetch_assoc();

  $todolist = array(
    "todolist_id" => $row['todolist_id'],
    "todolist" => $row['todolist']
  );

  $json = array(
    "is_success" => true,
    "data" => $todolist
  );

  $response = json_encode($json);
  echo $response;

?>