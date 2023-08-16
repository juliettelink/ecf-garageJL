<?php
if ($car["image1"] === null){
    $imagePath =_ASSETS_IMAGES_FOLDER_."default_car.jpg";
} else {
    $imagePath =_CARS_IMAGES_FOLDER_.htmlentities($car["image1"]);
}
?>

<div class="col-md-4 my-2">
    <div class="card">
        <img src="<?=$imagePath?>" class="card-img-top" alt="<?= htmlentities($car["model"])?>">
        <div class="card-body">
        <h5 class="card-title"><?= htmlentities($car["model"])?></h5>
        <p class="card-text"><?= htmlentities($car["color"])?></p>
        <p class="card-text"><?= htmlentities($car["price"])?></p>
        <p class="card-text"><?= htmlentities($car["full"])?></p>
        <a href="occasion.php?id=<?=$key?>" class="btn btn-secondary">Détails</a>
        </div>
    </div>
</div>