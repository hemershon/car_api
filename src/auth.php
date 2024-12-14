<?php
  require_once 'vendor/autoload.php';
  use Firebase\JWT\JWT;
  use Firebase\JWT\KEY;

  function generateToken($userId) {
    $key = "chave_tokey";
    $payload = [
      'iss' => "car_api",
      'iat' => time(),
      'exp' => time() + 3600,
      'user_id' => $userId

    ];
    return JWT::encode($payload, $key, 'HS256');
  }

  function validateToken($token) {
    try {
      $decode = JWT::decode($token, new Key("chave_tokey", 'HS256'));
      return $decode->user_id;
    } catch (Exception $e) {
      return null;
    }
  }
?>