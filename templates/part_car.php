

<div class="col-md-4 my-2">
    <div class="card">
        <img src="occasion/<?=htmlentities($pictures["image1"])?>" class="card-img-top" alt="<?= htmlentities($car["model"])?>">
        <div class="card-body">
        <h5 class="card-title"><?= htmlentities($car["model"])?></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="occasion.php?id=<?=$key?>" class="btn btn-secondary">Détails</a>
        </div>
    </div>
</div>