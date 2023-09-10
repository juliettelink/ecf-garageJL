<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";

require_once __DIR__ . "/lib/car.php";

$cars = getCars($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['year'])) {
 // Récupérez les paramètres de recherche depuis l'URL
 $year = $_GET['year'];
 $price = $_GET['price'];
 $kilometer = $_GET['kilometer'];
var_dump($kilometer);
 // Effectuez la recherche filtrée en fonction des paramètres
 $filteredCars = getFilteredCars($pdo, $year, $price, $kilometer);
 
 // Convertissez les résultats en JSON
 $jsonResult = json_encode($filteredCars);

 // Envoyez la réponse JSON
 header('Content-Type: application/json');

 var_dump($jsonResult);
 echo $jsonResult;

 // Vous pouvez arrêter l'exécution du script ici si nécessaire
 exit();

 // Utilisez $filteredCars pour afficher les résultats filtrés dans votre boucle foreach
} else {
 // Si aucune requête de filtrage n'a été effectuée, obtenez toutes les voitures
 $filteredCars = $cars;
}
?>

<h1> Présentation des occasions</h1>

<!-- formulaire pour les filtre -->
<form id="filter-form">
    <label for="year">Année</label>
    <input type="range" id="year" name="year">
    <label for="price">Prix</label>
    <input type="range" id="price" name="price">
    <label for="kilometer">kilométres</label>
    <input type="range" id="kilometer" name="kilometer">

    <input type="submit" value="Filter">
  <div id="error-message" style="display: none; color: red;"></div>
</form>


<!-- card cars -->
  <div class="row text-center car-list">
    <?php foreach ($cars as $key => $car) {
 require __DIR__ . "/templates/part_car.php";
}?>
  </div>

<?php
require_once __DIR__ . "/templates/footer.php";
?>
