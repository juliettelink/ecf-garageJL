<?php 
require_once __DIR__ ."/lib/config.php";
require_once __DIR__ ."/lib/pdo.php";
require_once __DIR__ ."/lib/car.php";

$id = $_GET["id"];
$car = $cars["$id"];

var_dump(getCarById($pdo, 2));

//$car = getCarById($pdo, $id);

require_once __DIR__ ."/lib/menu.php";

$mainMenu["occasion.php"] = ["head_title" => $car["model"], "meta_description" => htmlentities(substr($car["content"],0,250)), "exclude" => true];


require_once __DIR__ ."/templates/header.php";

?>
 

<div class="container col-xxl-8 px-4 py-5">
    <img src="occasion/<?=htmlentities($car["image1"])?>" class="d-block mx-lg-auto img-fluid" alt="<?=htmlentities($car["title"])?>" width="700" loading="lazy">
    <div class="row flex-lg-row align-items-center g-5 py-5">
        <div class="col-lg-12">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=htmlentities($car["model"])?></h1>  
            <p class="lead"><?=htmlentities($car["price"])?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Formulaire</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Retour</button>
            </div>
        </div>
    </div>
</div>

<?php 
require_once __DIR__ ."/templates/footer.php";
?>
