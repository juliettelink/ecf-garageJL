<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
//require_once __DIR__ . "fetch.php";
require_once __DIR__ . "/templates/header.php";

require_once __DIR__ . "/lib/car.php";

$cars = getCars($pdo);
//var_dump($cars);
?>
<h1> Présentation des occasions</h1>

<div class="price-range-block">


  <div id="slider-range" class="price-filter-range" name="rangeInput"></div>

  <div style="margin:30px auto">
    <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
    <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field" />
  </div>
  <div id="searchResults" class="search-results-block"></div>

</div>

<!-- formulaire pour les filtre -->
<!-- <form id="filter-form">
    <label for="year">Année</label>
    <input type="range" id="year" name="year">
    <label for="price">Prix</label>
    <input type="range" id="price" name="price">
    <label for="kilometer">kilomètres</label>
    <input type="range" id="kilometer" name="kilometer">

    <input type="submit" value="Filter">
    <div id="error-message" style="display: none; color: red;"></div>
</form> -->

<!-- presentation des cards voitures -->
  <div class="row text-center ">
    <?php foreach ($cars as $key => $car) {
    require __DIR__ . "/templates/part_car.php";
}?>
  </div>


<?php
require_once __DIR__ . "/templates/footer.php";
?>

