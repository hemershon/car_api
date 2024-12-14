<?php
require_once 'config/database.php';

function listCars($pdo) {
    $stmt = $pdo->query("SELECT * FROM cars");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addCar($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO cars (name, brand, year) VALUES (:name, :brand, :year)");
    $stmt-execute([
        ':name' => $data['name'],
        ':brand' => $data['brand'],
        'year' => $data['year']
    ]);
    return $pdo->lastInsertId();
}
?>