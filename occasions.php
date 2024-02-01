<?php

require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/lib/car.php";
require_once __DIR__ . "/lib/filter.php";

$year = $_GET['year'] ?? null;
$kilometer = $_GET['kilometer'] ?? null;
$price = $_GET['price'] ?? null;

$cars = getCars($pdo);
$filteredCars = filterCars($pdo, $cars, $year, $kilometer, $price);

?>

<div class="container">
    <h1>Présentation des occasions</h1>

    <div class="filter-block">
        <label for="year">Année : <span id="yearValue">2009</span></label>
        <input type="range" min="2000" max="2023" id="year" class="filter-field" />

        <label for="kilometer">Kilométrage : <span id="kilometerValue">50050</span></label>
        <input type="range" min="1000" max="1000000" id="kilometer" class="filter-field" />

        <label for="price">Prix : <span id="priceValue">255000</span></label>
        <input type="range" min="10000" max="900000" id="price" class="filter-field" />

        <div id="searchResults" class="search-results-block"></div>
    </div>

    <div class="row text-center" id="car-container">
        <?php foreach ($filteredCars as $key => $car) {
            require __DIR__ . "/templates/part_car.php";
        } ?>
    </div>
</div>
<?php

require_once __DIR__ . "/templates/footer.php";
?>

<script>
    const DEFAULT_IMAGE_FOLDER = <?= json_encode(_DEFAULT_IMAGE_FOLDER_) ?>;
    const CARS_IMAGES_FOLDER = <?= json_encode(_CARS_IMAGES_FOLDER_) ?>;
</script>

