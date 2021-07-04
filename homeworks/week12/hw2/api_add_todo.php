<?php
  require_once("conn.php");
  require_once("utils.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if (empty($_POST['todo_list'])) {
    get_todoAPI_result(false, "Please input content.");
    die();
  }

  $todo_list = $_POST['todo_list'];

  $sql = "INSERT INTO keke_todolists (todolist) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $todo_list);

  $result = $stmt->execute();
  if (!$result) {
    get_todoAPI_result(false, $conn->error, null);
    die();
  }

  get_todoAPI_result(true, "Success!", $conn->insert_id); 

?>