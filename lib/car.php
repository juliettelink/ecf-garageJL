<?php 

//fonction pour le formulaire de contact avec les modèles de voitures
function getCarsModels(PDO $pdo): array
{
    $sql = "SELECT DISTINCT model FROM cars";
    $query = $pdo->query($sql);
    $models = $query->fetchAll(PDO::FETCH_COLUMN);
    return $models;
}

//fonction card cars
function getCars(PDO $pdo, int $limit = null, int $page = null):array
{
  $sql = "SELECT c.*, p.* 
          FROM cars c 
          LEFT JOIN pictures p ON c.car_id = p.car_id 
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
// var_dump($cars);
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
   return _ASSETS_IMAGES_FOLDER_ . "null.jpg";
} else {
    return _CARS_IMAGES_FOLDER_ . htmlentities($image);
}
}

//fonction saveCar
function saveCar(PDO $pdo, string $model, int $year, int $price, int $kilometer, string $full, string $color, 
                  string|null $image1, int $id = null): bool
{
    // cohérence entre les deux tables
    $pdo->beginTransaction();

    try {
        if ($id === null) {
            // insertion de voiture dans la table cars
            $carQuery = $pdo->prepare("INSERT INTO cars(model, year, price, kilometer, full, color) 
                                        VALUES (:model, :year, :price, :kilometer, :full, :color)");
            $carQuery->bindValue(':model', $model, PDO::PARAM_STR);
            $carQuery->bindValue(':year', $year, PDO::PARAM_INT);
            $carQuery->bindValue(':price', $price, PDO::PARAM_INT);
            $carQuery->bindValue(':kilometer', $kilometer, PDO::PARAM_INT);
            $carQuery->bindValue(':full', $full, PDO::PARAM_STR);
            $carQuery->bindValue(':color', $color, PDO::PARAM_STR);
            $carQuery->execute();

            // récupérer l'id 
            $id = $pdo->lastInsertId();

            var_dump($id);
            // Insertion des images dans la table pictures
            if ($image1) {
                $pictureQuery = $pdo->prepare("INSERT INTO pictures(car_id, image1) 
                                                VALUES (:id, :image1)");
                $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
                $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
                $pictureQuery->execute();
            }
        } else {
            // mise à jour de la table cars
            $carQuery = $pdo->prepare("UPDATE cars SET model = :model, year = :year, price = :price, kilometer = :kilometer,
                                      full = :full, color = :color WHERE car_id = :id");
            $carQuery->bindValue(':id', $id, PDO::PARAM_INT);
            $carQuery->bindValue(':model', $model, PDO::PARAM_STR);
            $carQuery->bindValue(':year', $year, PDO::PARAM_INT);
            $carQuery->bindValue(':price', $price, PDO::PARAM_INT);
            $carQuery->bindValue(':kilometer', $kilometer, PDO::PARAM_INT);
            $carQuery->bindValue(':full', $full, PDO::PARAM_STR);
            $carQuery->bindValue(':color', $color, PDO::PARAM_STR);
            $carQuery->execute();

            // Mise à jour des images associées à la voiture dans la table pictures
            if ($image1) {
                $pictureQuery = $pdo->prepare("UPDATE pictures SET image1 = :image1 
                                                WHERE car_id = :id ");
                $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
                $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
                $pictureQuery->execute();
            }
        }

        // Commit 
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        // Exception / annulation
        $pdo->rollBack();
        return false;
    }
}




function getPicturesByCarId(PDO $pdo, int $Id)
{     
  $sql = "SELECT * FROM pictures WHERE car_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(":id", $Id, PDO::PARAM_INT);
  $query->execute();
  return $query->fetch(PDO::FETCH_ASSOC);
}



//fonction delet car
function deleteCar(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM cars WHERE car_id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

  ?>





