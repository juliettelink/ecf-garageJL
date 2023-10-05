<?php

function getOpeningTimes($pdo)
{
  $sql = "SELECT *
          FROM openingTimes";

$query = $pdo->prepare($sql);

$query->execute();
$openingTimes = $query->fetchAll(PDO::FETCH_ASSOC);

  return $openingTimes;
}


// J4EN AI PAS BESOIN
// function getOpeningTimesById(PDO $pdo, int $id): array|bool
// {
//     $query =$pdo->prepare("SELECT * FROM services WHERE service_id=:id");
//     $query->bindValue(":id", $id, PDO::PARAM_INT);
//     $query->execute();
//     return $query->fetch(PDO::FETCH_ASSOC);
// }
