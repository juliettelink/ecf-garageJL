<?php 
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/openingTimes.php";
require_once __DIR__ . "/templates/header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

adminOnly();

$openingTimes = getOpeningTimes($pdo);

?>

<h1 class="py-3">Changement des Horaires</h1>

<table class="table table-striped" id="openingTimesTable">
    <thead>
        <tr class="table-dark">
            <th scope="col">Jours</th>
            <th scope="col">debut matin</th>
            <th scope="col">fin matin</th>
            <th scope="col">debut ap</th>
            <th scope="col">fin ap</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($openingTimes as $openingTime): ?>
            <tr>
                <th scope="row"><?= $openingTime['day']; ?></th>
                <td class="editable" data-column="morningOpen" data-id="<?= $openingTime['openingTime_id']; ?>" contenteditable="true"><?= $openingTime['morningOpen']; ?></td>
                <td class="editable" data-column="morningClose" data-id="<?= $openingTime['openingTime_id']; ?>" contenteditable="true"><?= $openingTime['morningClose']; ?></td>
                <td class="editable" data-column="afternoonOpen" data-id="<?= $openingTime['openingTime_id']; ?>" contenteditable="true"><?= $openingTime['afternoonOpen']; ?></td>
                <td class="editable" data-column="afternoonClose" data-id="<?= $openingTime['openingTime_id']; ?>" contenteditable="true"><?= $openingTime['afternoonClose']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button id="submitChanges">Enregistrer les changements</button>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
