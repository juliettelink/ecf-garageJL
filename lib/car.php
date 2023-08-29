<?php 


// fonction card cars
function getCars(PDO $pdo, int $limit = null, int $page = null):array
{
  $sql = "SELECT c.*, p.* 
          FROM cars c 
          INNER JOIN pictures p 
          ON c.car_id = p.car_id 
          ORDER BY c.car_id DESC";

  if ($limit && !$page) {
    $sql .= " LIMIT :limit ";
  }
  // uniquement pour ajouter des pages dans admin car
  if ($page){
    $sql .= " LIMIT :offset, :limit";
  }

  $query = $pdo->prepare($sql);

  if ($limit) {
    // securité pour passer les variables
    //  $limit limite dans l'index pour avoir 3 annonces
    $query->bindValue(":limit", $limit, PDO::PARAM_INT);
  }
  // aussi uniquement pour ajouter  des page dans admin car
  if ($page) {
    $offset = ($page -1) * $limit;
    $query->bindValue(":offset", $offset, PDO::PARAM_INT);
  }
  $query->execute();
  $cars = $query->fetchAll(PDO::FETCH_ASSOC);

  return $cars;
}

// fonction pour la pagination
function getTotalCar(PDO $pdo):int
{
  $sql = "SELECT COUNT(*) as total
          FROM cars";

  $query = $pdo->prepare($sql);

  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);

  return $result["total"];
}

// fonction pour présentation d'une voiture
function getCarById(PDO $pdo, $id):array|bool
{
  $sql = "SELECT c.*, p.* 
          FROM cars c 
          INNER JOIN pictures p ON c.car_id = p.car_id 
          WHERE c.car_id = :id";

  $query = $pdo->prepare($sql);

  $query->bindValue(":id", $id, PDO::PARAM_INT);

  $query->execute();
  $car = $query->fetch(PDO::FETCH_ASSOC);

  return $car;
}

//function pour l'image par défault

function getCarImage(string|null $image):string
{
  if ($image === null){
   return _ASSETS_IMAGES_FOLDER_."null.jpg";
} else {
    return _CARS_IMAGES_FOLDER_.htmlentities($image);
}
}
  ?>

