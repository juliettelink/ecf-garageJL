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
          LEFT JOIN pictures p ON c.car_id = p.car_id 
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
  if ($image === null || $image === "null.jpg"){
   return _DEFAULT_IMAGE_FOLDER_ ."null.jpg"; 
} else {
    return _CARS_IMAGES_FOLDER_ . htmlentities($image);
}
}

// fonction de la table pictures
function getPicturesByCarId(PDO $pdo, int $Id)
{     
  $sql = "SELECT * FROM pictures WHERE car_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(":id", $Id, PDO::PARAM_INT);
  $query->execute();
  return $query->fetch(PDO::FETCH_ASSOC);
}



//fonction saveCar
function saveCar(PDO $pdo, string $model, int $year, float $price, int $kilometer, string $full, string $color, 
                  string|null $image1, int $id = null)
{
    $pdo->beginTransaction();

    try {
        $query = null;

        if ($id === null) {
            // Insertion de voiture dans la table cars
            $query = $pdo->prepare("INSERT INTO cars(model, year, price, kilometer, full, color) 
                                    VALUES (:model, :year, :price, :kilometer, :full, :color)");
            $query->bindValue(':model', $model, PDO::PARAM_STR);
            $query->bindValue(':year', $year, PDO::PARAM_INT);
            $query->bindValue(':price', $price, PDO::PARAM_STR);
            $query->bindValue(':kilometer', $kilometer, PDO::PARAM_INT);
            $query->bindValue(':full', $full, PDO::PARAM_STR);
            $query->bindValue(':color', $color, PDO::PARAM_STR);
            $query->execute();

            // Récupération de l'ID généré
            $id = $pdo->lastInsertId();
        } else {
            // Mise à jour de la table cars
            $query = $pdo->prepare("UPDATE cars SET model = :model, year = :year, price = :price, kilometer = :kilometer,
                                    full = :full, color = :color WHERE car_id = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':model', $model, PDO::PARAM_STR);
            $query->bindValue(':year', $year, PDO::PARAM_INT);
            $query->bindValue(':price', $price, PDO::PARAM_STR);
            $query->bindValue(':kilometer', $kilometer, PDO::PARAM_INT);
            $query->bindValue(':full', $full, PDO::PARAM_STR);
            $query->bindValue(':color', $color, PDO::PARAM_STR);
            $query->execute();
        }

        // Vérifie si existe dans la table pictures
          $existingPicture = getPicturesByCarId($pdo, $id);
        // Insertion des images 
        if ($image1) {
          // mise à jour de l'image
          if ($existingPicture) {
              $pictureQuery = $pdo->prepare("UPDATE pictures SET image1 = :image1 WHERE car_id = :id");
              $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
              $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
              $pictureQuery->execute();
          } else {
              // insere une nouvelle image
              $pictureQuery = $pdo->prepare("INSERT INTO pictures(car_id, image1) 
                                              VALUES (:id, :image1)");
              $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
              $pictureQuery->bindValue(':image1', $image1, PDO::PARAM_STR);
              $pictureQuery->execute();
          }
      } else {
          // pas d'image fournie et qu'il y a une entrée existante, ne rien faire
          if (!$existingPicture) {
              // insersion d'une image par défault
              $defaultImage = _DEFAULT_IMAGE_FOLDER_."null.jpg";  
              $pictureQuery = $pdo->prepare("INSERT INTO pictures(car_id, image1) 
                                              VALUES (:id, :image1)");
              $pictureQuery->bindValue(':id', $id, PDO::PARAM_INT);
              $pictureQuery->bindValue(':image1', $defaultImage, PDO::PARAM_STR);
              $pictureQuery->execute();
          }
      }

        // Commit 
        $pdo->commit();

        // Retourne l'ID si l'opération a réussi, sinon retourne false
        return $id !== null ? $id : false;
    } catch (PDOException $e) {
        // Exception / annulation
        $pdo->rollBack();
        return false;
    }
}




//fonction suppression d'un modele dans la bdd cars et pictures
function deleteCar(PDO $pdo, int $id) :bool
 {
  $picturesQuery = "DELETE FROM pictures WHERE car_id = :car_id";
  $picturesStmt = $pdo->prepare($picturesQuery);
  $picturesStmt->bindParam(":car_id", $id, PDO::PARAM_INT);
  $picturesStmt->execute();

  $carQuery = "DELETE FROM cars WHERE car_id = :car_id";
  $carStmt = $pdo->prepare($carQuery);
  $carStmt->bindParam(":car_id", $id, PDO::PARAM_INT);
  $carStmt->execute();

  // vérifie le nombre de lignes affectées
  $rowsAffectedPictures = $picturesStmt->rowCount();
  $rowsAffectedCar = $carStmt->rowCount();

  return ($rowsAffectedPictures > 0 && $rowsAffectedCar > 0);
}
  ?>

