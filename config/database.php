<?php
  $host = '127.0.0.1';
  $db = 'car_api';
  $user = 'root';
  $password = '';

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
  }
?>