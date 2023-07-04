<?php 
require __DIR__ ."/lib/car.php";
$id = $_GET["id"];
$car = $cars[$id];

require __DIR__ ."/lib/menu.php";

$mainMenu["characteristic.php"] = ["head_title"=>$car["title"], "meta_description"=> $car["content"]];


require __DIR__ ."/templates/header.php";




?>
<h1> voiture </h1>
<p> les caractéristiques</p>

<div class="container col-xxl-8 px-4 py-5">
    <img src="occasion/<?=$car["image"]?>" class="d-block mx-lg-auto img-fluid" alt="<?=$car["title"]?>" width="700" height="500" loading="lazy">
    <div class="row flex-lg-row align-items-center g-5 py-5">
        <div class="col-lg-12">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=$car["title"]?></h1>
            <p class="lead"><?=$car["content"]?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Formulaire</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Retour</button>
            </div>
        </div>
    </div>
</div>

<?php 
require __DIR__ ."/templates/footer.php";
?>
