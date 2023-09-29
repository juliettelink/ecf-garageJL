<?
    require __DIR__ . "lib.config.php";
    require __DIR__ . "lib.pdo.php";
//filtre voiture


    $query = "SELECT * FROM cars WHERE id >= 0 ";
    $r = mysqli_query($con,$query);


    //kilométre

