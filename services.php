<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/lib/service.php";

// appelle la fonction pour obtenir la liste de services
$services = getAllServices($pdo);
?>


<div class="container">
    <h1>Présentation de nos services</h1>
    <?php
    if ($services) {
        foreach ($services as $service) {
            // Pour chaque service, affichez ses détails
            $imagePath = getServiceImage($service["image"]);
            ?>
        <div class="container">
            <div class="row text-center justify-content-center ">
                <div class=" col col-md-6 my-2 ">
                    <div class="card">
                        <img src="<?=$imagePath?>" class="card-img" alt="<?=htmlentities($service["image"])?>">
                        <div class="card-body">
                            <h5 class="card-title"><?=htmlentities($service["service"])?></h5>
                            <p class="card-text"><?=htmlentities($service["description"])?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    } else {?>

    <p> Aucun services trouvé </p>
    <?php }?>
</div>

<?php
require_once __DIR__ . "/templates/footer.php";
?>
