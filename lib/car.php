<?php 


      
      $cars = [
        ["title" => "voiture 1", "content"=>"Test","année"=>"2008", "type"=>"diesel", "kilomètre"=> "17220 km", "price"=>"2000 €", "image"=>"00car.png"],
        ["title" => "voiture 2", "content"=>"Test", "image"=>"01car.png"],
        ["title" => "voiture 3", "content"=>"Test", "image"=>"02car.png"]
      ];



  function getCars(PDO $pdo):array
  {
    $query = $pdo->prepare("SELECT * FROM cars");
    $query->execute();
    $cars = $query->fetchAll(PDO::FETCH_ASSOC);

    return $cars;
  }

  function getPictures(PDO $pdo):array
  {
    $query = $pdo->prepare("SELECT * FROM pictures");
    $query->execute();
    $pictures = $query->fetchAll(PDO::FETCH_ASSOC); 

    return $pictures;
  }


  ?>

