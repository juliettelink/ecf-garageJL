<?php 
require_once __DIR__ ."/lib/config.php";
require_once __DIR__ ."/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ ."/templates/header.php";

require_once __DIR__. "/lib/car.php";

$cars = getCars($pdo);

?>
<h1> Présentation des occasions</h1>

<p>mettre les filtres en place</p>

  <div class="row text-center ">
    <?php foreach($cars as $key => $car){ 
      require __DIR__. "/templates/part_car.php";
    } ?>
  </div>

<?php 
require_once __DIR__ ."/templates/footer.php";
?>
