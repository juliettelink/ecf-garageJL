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

$maxYear = 2024;
$maxKilometer = 1000000;
$maxPrice = 900000;

?>

<div class="container">
    <h1>Présentation des occasions</h1>

    <div class="filter-block row">
        <div class="col-md-4 col-12">
            <label for="year">Année : <span id="yearValue"><?=$maxYear?></span></label>
            <input type="range" min="2010" max="<?=$maxYear?>" id="year" class="filter-field" value="<?=$maxYear?>" />
        </div>

        <div class="col-md-4 col-12">   
            <label for="kilometer">Kilométrage : <span id="kilometerValue"><?=$maxKilometer?></span></label>
            <input type="range" min="1000" max="<?=$maxKilometer?>" id="kilometer" class="filter-field" value="<?=$maxKilometer?>" />
        </div>

        <div class="col-md-4 col-12">
            <label for="price">Prix : <span id="priceValue"><?=$maxPrice?></span></label>
            <input type="range" min="10000" max="<?=$maxPrice?>" id="price" class="filter-field" value="<?=$maxPrice?>" />
        </div>

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

<!-- le chemin des images pour le JS -->

<script>
    const DEFAULT_IMAGE_FOLDER = <?= json_encode(_DEFAULT_IMAGE_FOLDER_) ?>;
    const CARS_IMAGES_FOLDER = <?= json_encode(_CARS_IMAGES_FOLDER_) ?>;
</script>

