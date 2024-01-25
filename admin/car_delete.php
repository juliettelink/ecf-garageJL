<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";


require_once __DIR__ . "/../lib/pdo.php";

require_once __DIR__ . "/../lib/car.php";
require_once __DIR__ . "/templates/header.php";

employeAndAdmin();

$car = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $car =  getCarById($pdo, (int)$_GET["id"]);
}
if ($car) {
    if (deleteCar($pdo, $_GET["id"])) {
        $messages[] = "L'article a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'article n'existe pas";
}

?>
<div class="row text-center my-5">
    <h1>Supression du modéle</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
</div>


<?php require_once __DIR__ . "/templates/footer.php"; ?>