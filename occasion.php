<?php 
require __DIR__ ."/templates/header.php";
require __DIR__. "/lib/car.php";
?>
<h1> presentation des occasions</h1>

  <div class="row text-center ">
    <?php foreach($cars as $key => $car){ 
      require __DIR__. "/templates/part_car.php";
    }?>
  </div>

<?php 
require __DIR__ ."/templates/footer.php";
?>
