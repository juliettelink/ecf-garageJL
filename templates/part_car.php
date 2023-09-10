<?php
$imagePath = getCarImage($car["image1"]);
?>

<div class="col-md-4 my-2">
    <div class="card">
        <img src="<?=$imagePath?>" class="card-img-top" alt="<?= htmlentities($car["model"])?>">
        <div class="card-body">
        <h5 class="card-title"><?= htmlentities($car["model"])?></h5>
        <p class="card-text">Année : <?= htmlentities($car["year"])?></p>
        <p class="card-text"><?= htmlentities($car["price"])?> €</p>
        <p class="card-text"><?= htmlentities($car["kilometer"])?> Km</p>
        <a href="occasion.php?id=<?=$car["car_id"]?>" class="btn btn-secondary">Détails</a>
        </div>
    </div>
</div>