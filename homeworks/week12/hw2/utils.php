<?php
  require_once("conn.php");
  
  function get_todoAPI_result($is_success, $message, $todolist_id) {
    if ($todolist_id) {
      $json = array(
        "is_success" => $is_success,
        "message" => $message,
        "todolist_id" => $todolist_id
      );
    } else {
      $json = array(
        "is_success" => $is_success,
        "message" => $message
      );
    }
    
    $response = json_encode($json);
    echo $response;
  }

?>