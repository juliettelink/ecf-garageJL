<?php 
require_once __DIR__. "/templates/header.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/car.php";

if (isset($_GET["page"])) {
    $currentPage = (int)$_GET["page"];
} else {
    $currentPage = 1;
}

$cars = getCars($pdo, _ADMIN_ITEM_PER_PAGE_, $currentPage);

$totalCars = getTotalCar($pdo);
$totalPages = ceil($totalCars / _ADMIN_ITEM_PER_PAGE_ );

?>

<h1 class="py-3">Listes des voitures</h1>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Modele</th>
        <th scope="col">Année</th>
        <th scope="col">Prix</th>
        <th scope="col">Kilométre</th>
        <th scope="col">Carburant</th>
        <th scope="col">Couleur</th>
        <th scope="col">Image 1</th>
        <th scope="col">Image 2</th>
        <th scope="col">Image 3</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cars as $car) {?>
        <tr>
        <th scope="row"><?= $car["car_id"] ?></th>
        <td><?= $car["model"] ?></td>
        <td><?= $car["year"] ?></td>
        <td><?= $car["price"] ?></td>
        <td><?= $car["kilometer"] ?></td>
        <td><?= $car["full"] ?></td>
        <td><?= $car["color"] ?></td>
        <td><?= $car["image1"] ?></td>
        <td><?= $car["image2"] ?></td>
        <td><?= $car["image3"] ?></td>
        <td>Modifier | Supprimer</td>
        <?php } ?>
        </tr>
    </tbody>
    </table>

    <?php if($totalPages > 1){?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php  for ($i = 1; $i <= $totalPages; $i++){ ?>
                <li class="page-item <?php if($i === $currentPage) { echo "active";}?>"><a class="page-link" href="?page=<?=$i;?>"><?=$i;?></a></li>
            <?php } ?>
        </ul>
    </nav>
    <?php } ?>




<?php 
require_once __DIR__. "/templates/footer.php";

?>
