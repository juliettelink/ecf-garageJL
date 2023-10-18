<?php
  

// Fonction pour filtrer les voitures en fonction des critères
function filterCars(PDO $pdo, ?array $cars, $year, $kilometer, $price): array
{
       $cars = $cars ?? [];
    // Filtrer les voitures en fonction de l'année des kilométre et du prix
    $filteredCars = [];

    foreach ($cars as $car) {
        // Appliquer les conditions de filtrage
        $passFilter = true;

        if ($year !== null && $car['year'] < $year) {
            $passFilter = false;
        }

        if ($kilometer !== null && $car['kilometer'] > $kilometer) {
            $passFilter = false;
        }

        if ($price !== null && $car['price'] > $price) {
            $passFilter = false;
        }

        // Si la voiture passe tous les filtres, l'ajouter à la liste filtrée
        if ($passFilter) {
            $filteredCars[] = $car;
        }
    }

    return $filteredCars;
}
?>

