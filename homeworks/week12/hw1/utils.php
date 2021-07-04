<?php
  require_once("conn.php");
  
  function get_add_comment_result($is_success, $message) {
    $json = array(
      "is_success" => $is_success,
      "message" => $message
    );

    $response = json_encode($json);
    echo $response;
  }

?>