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

//fonction saveCar
function saveCar(PDO $pdo, string $model, int $year, string $price, string $kilometer, string $full, string $color, 
                  string|null $image1, string|null $image2, string|null $image3, int $id = null)
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
            $carQuery->bindValue(':price', $price, PDO::PARAM_STR);
            $carQuery->bindValue(':kilometer', $kilometer, PDO::PARAM_STR);
            $carQuery->bindValue(':full', $full, PDO::PARAM_STR);
            $carQuery->bindValue(':color', $color, PDO::PARAM_STR);
            $carQuery->execute();

            // récupere l'id 
            $carId = $pdo->lastInsertId();

            // insertion des images dans la table picture
            $pictureQuery = $pdo->prepare("INSERT INTO pictures(is_principal, image1, image2, image3, car_id) 
                                            VALUES (1, :image1, :image2, :image3, :carId)");
            $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
            $pictureQuery->bindValue(':image2', $image2, PDO::PARAM_STR);
            $pictureQuery->bindValue(':image3', $image3, PDO::PARAM_STR);
            $pictureQuery->bindValue(':carId', $carId, PDO::PARAM_INT);
            $pictureQuery->execute();
        } else {
            // mise à jour de la table cars
            $carQuery = $pdo->prepare("UPDATE cars SET model = :model, year = :year, price = :price, kilometer = :kilometer,
                                      full = :full, color = :color WHERE car_id = :id");
            $carQuery->bindValue(':id', $id, PDO::PARAM_INT);
            $carQuery->bindValue(':model', $model, PDO::PARAM_STR);
            $carQuery->bindValue(':year', $year, PDO::PARAM_INT);
            $carQuery->bindValue(':price', $price, PDO::PARAM_STR);
            $carQuery->bindValue(':kilometer', $kilometer, PDO::PARAM_STR);
            $carQuery->bindValue(':full', $full, PDO::PARAM_STR);
            $carQuery->bindValue(':color', $color, PDO::PARAM_STR);
            $carQuery->execute();

            // mise à jour de la table pictures
            $pictureQuery = $pdo->prepare("UPDATE pictures SET image1 = :image1, image2 = :image2, image3 = :image3
                                            WHERE car_id = :id");
            $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
            $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
            $pictureQuery->bindValue(':image2', $image2, PDO::PARAM_STR);
            $pictureQuery->bindValue(':image3', $image3, PDO::PARAM_STR);
            $pictureQuery->execute();

            $carId = $id; 
        }
        // commit 
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        // exeption / annulation
        $pdo->rollBack();
        return false;
    }
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



