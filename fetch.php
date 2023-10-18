<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/car.php";

$year = isset($_GET['year']) ? $_GET['year'] : null;
$kilometer = isset($_GET['kilometer']) ? $_GET['kilometer'] : null;
$price = isset($_GET['price']) ? $_GET['price'] : null;

//  la fonction de filtrage
require_once __DIR__ . "/lib/filter.php";

header('Content-Type: application/json');

try {
    $filteredCars = filterCars($pdo, getCars($pdo), $year, $kilometer, $price);
    echo json_encode($filteredCars);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
