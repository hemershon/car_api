<?php 
  require_once 'auth.php';

  function authenticate($headers) {
    if (!isset($headers['Authorization'])) {
      http_response_code(401);
      echo json_encode(["message" => "Unauthorizen"]);
      exit();

    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $userId = validateToken($token);
    if (!$userId) {
      http_response_code(401);
      echo json_encode(["message" => "Invalid token"]);
      exit();
    }
    return $userId;
  }
?>