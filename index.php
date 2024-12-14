<?php
  header("Content-Type: application/json");
  require_once 'config/database.php';
  require_once 'src/auth.php';
  require_once 'src/car.php';

  $headers = getallheaders();
  $method = $_SERVER['REQUEST_METHOD'];
  $path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

  if ($path[0] === 'login' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $input['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($input['password'], $user['password'])) {
      $token = generateToken($user['id']);
      echo json_encode(["message" => "Invalid credentials"]);
    }
    exit();
  }

  if ($path[0] === 'cars') {
    $userId = authenticate($headers);
    
    if (method === 'GET') {
      $cars = listCars($pdo);
      echo json_encode($cars);

    } elseif ($method === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $carId = addCar($pdo, $input);
      echo json_encode(["message" => "Car added", "id" => $carId]);
    }
    exit();
  }
  http_response_code(404);
  echo json_encode(["message" => "Route not found"]);

?>