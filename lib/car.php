<?php 

  function getCars(PDO $pdo, int $limit = null):array
  {
    $sql = "SELECT * FROM cars c INNER JOIN pictures p ON c.car_id = p.picture_id ORDER BY c.car_id DESC";
    if ($limit) {
      $sql .= " LIMIT :limit ";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
      // securité pour passer les variables
      //  $limit limite dans l'index pour avoir 3 annonces
      $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    $query->execute();
    $cars = $query->fetchAll(PDO::FETCH_ASSOC);

    return $cars;
  }

  function getCarById(PDO $pdo, int $id):array

  {
    $sql = "SELECT * FROM cars c INNER JOIN pictures p ON c.car_id = p.picture_id, WHERE car_id = ':id'";

    $query = $pdo->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);

    $query->execute();
    $car = $query->fetch(PDO::FETCH_ASSOC);

    return $car;
  }

  ?>

