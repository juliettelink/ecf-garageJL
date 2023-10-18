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
        <label for="year">Année</label>
        <input type="range" min="1995" max="2023" id="year" class="filter-field" />

        <label for="kilometer">Kilométrage</label>
        <input type="range" min="10000" max="10000000" id="kilometer" class="filter-field" />

        <label for="price">Prix</label>
        <input type="range" min="10000" max="500000" id="price" class="filter-field" />

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
    document.addEventListener("DOMContentLoaded", function () {
        const yearInput = $("#year");
        const kilometerInput = $("#kilometer");
        const priceInput = $("#price");
        const carContainer = $("#car-container");
        const searchResults = $("#searchResults");


        function getCarImage(image) {
            if (!image) {
                return "_DEFAULT_IMAGE_FOLDER_ + 'null.jpg'";
            } else {
                return "_CARS_IMAGES_FOLDER_" + encodeURIComponent(image);
            }
        }

        function fetchCars() {
            const year = yearInput.val();
            const kilometer = kilometerInput.val();
            const price = priceInput.val();

            fetch(`fetch.php?year=${year}&kilometer=${kilometer}&price=${price}`)
                .then(response => response.json())
                .then(cars => {
                    carContainer.empty();
                    cars.forEach(car => {

                         // Appel à la fonction getCarImage pour obtenir le chemin de l'image
                        const imagePath = getCarImage(car.image1);
                        carContainer.append(`
                        <div class="col-md-4 my-2">
                        <div class="card">
                            <img src="${imagePath}" class="card-img" alt="${car.model}">
                            <div class="card-body">
                                <h5 class="card-title">${car.model}</h5>
                                <p class="card-text">Année : ${car.year}</p>
                                <p class="card-text">${car.price} €</p>
                                <p class="card-text">${car.kilometer} Km</p>
                                
                                <a href="occasion.php?id=${car.car_id}" class="btn btn-secondary">Détails</a>
                            </div>
                        </div>
                    </div>
                        `); 
                    });
                })
                .catch(error => console.error('Erreur :', error));
        }

        yearInput.add(kilometerInput).add(priceInput).on("input", function () {
            fetchCars();
        });
    });
</script>
