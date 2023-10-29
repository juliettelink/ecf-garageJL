<?php 
require_once __DIR__. "/../lib/config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/service.php";
require_once __DIR__. "/templates/header.php";

adminOnly();

$services = getAllServices($pdo);



?>

<h1 class="py-3">Listes des services</h1>

<div class="d-flex gap-é justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="service.php">
        Ajouter un service
    </a>
</div>
<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Service</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($services as $service) {?>
        <tr>
        <th scope="row"><?= $service["service_id"] ?></th>
        <td><?= $service["service"] ?></td>
        <td><?= $service["description"] ?></td>
        <td><?= $service["image"] ?></td>
        <td>
            <a href="service.php?id=<?=$service['service_id']?>" class="btn btn-success">Modifier</a>
            <a href="service_delete.php?id=<?=$service['service_id']?>" class="btn btn-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer ce service')">Supprimer</a>
        </td>
        <?php } ?>
        </tr>
    </tbody>
    </table>





<?php 
require_once __DIR__. "/templates/footer.php";

?>