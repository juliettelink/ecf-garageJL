<?php 
require_once __DIR__ ."/lib/config.php";
require_once __DIR__ ."/lib/pdo.php";
require_once __DIR__ ."/lib/car.php";


require_once __DIR__ ."/lib/menu.php";
$mainMenu["occasion.php"] = ["head_title" => "modéle de voiture introuvable", "meta_description" =>" modéle de voiture introuvable", "exclude" => true];

$error = false;

//gestion d'erreur quand on ne passe pas d'id et quand on en passe 1. on peut aussi le faire avec un switch
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $car = getCarById($pdo, $id);

    if ($car){ 
        $imagePath = getCarImage($car["image1"]);
        $mainMenu["occasion.php"] = ["head_title" => $car["model"], "meta_description" => htmlentities(substr($car["model"],0,250)), "exclude" => true];
    } else {
        $error = true;
    }
}else{
    $error = true;   
}

// var_dump($error);
//  die;


require_once __DIR__ ."/templates/header.php";

?>

<!-- cas où il n'y a pas d'erreur-->
<?php if(!$error) { ?>
    <div class="container col-xxl-8 px-4 py-5">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=htmlentities($car["model"])?></h1>
        <img src="<?=$imagePath?>" class="d-block mx-lg-auto img-fluid" alt="<?=htmlentities($car["model"])?>" width="700" loading="lazy">
        <?php if (!empty($car["image2"])) { ?>
            <img src="<?= getCarImage($car["image2"]) ?>" class="d-block mx-lg-auto img-fluid" alt="<?= htmlentities($car["model"]) ?>" width="400" loading="lazy">
        <?php } else { ?>
            <img src="<?= _ASSETS_IMAGES_FOLDER_ ?>null.jpg"  class="d-block mx-lg-auto img-fluid" alt="Image par défaut" width="400" loading="lazy">
        <?php } ?>

        <?php if (!empty($car["image3"])) { ?>
            <img src="<?= getCarImage($car["image3"]) ?>" class="d-block mx-lg-auto img-fluid" alt="<?= htmlentities($car["model"]) ?>" width="400" loading="lazy">
        <?php } else { ?>
            <img src="<?= _ASSETS_IMAGES_FOLDER_ ?>null.jpg"  class="d-block mx-lg-auto img-fluid" alt="Image par défaut" width="400" loading="lazy">
        <?php } ?>
        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-lg-12"> 
                <p class="lead">Couleur : <?=htmlentities($car["color"])?></p>
                <p class="lead">Prix : <?=htmlentities($car["price"])?></p>
                <p class="lead">Kilmométre : <?=htmlentities($car["kilometer"])?></p>
                <p class="lead">Année : <?=htmlentities($car["year"])?></p>
                <p class="lead">Carburant : <?=htmlentities($car["full"])?></p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Formulaire</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Retour</button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <h2>Modéle de voiture introuvable</h2>
<?php } ?>

<?php 
require_once __DIR__ ."/templates/footer.php";
?>
