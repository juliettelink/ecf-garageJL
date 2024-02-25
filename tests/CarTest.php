<?php

use PHPUnit\Framework\TestCase;


require_once 'lib/car.php';


class CarTest extends TestCase
{
    public function testSaveCar()
    {
        // Configuration d'une connexion PDO pour les tests
        $pdo = new PDO('sqlite::memory:');
        // Création de la table cars et pictures pour éviter des erreurs lors de l'ajout de voitures
        $pdo->exec("CREATE TABLE IF NOT EXISTS cars (car_id INTEGER PRIMARY KEY, model TEXT, year INTEGER, price TEXT, kilometer INTEGER, full TEXT, color TEXT)");
        $pdo->exec("CREATE TABLE IF NOT EXISTS pictures (car_id INTEGER PRIMARY KEY, image1 TEXT)");

    // Appel de la fonction saveCar avec des données de test
    $result = saveCar($pdo, 'Toyota Camry', 2022, '30000.00', 15000, 'Full', 'Blue', 'image_path.jpg');

    // Assertion pour vérifier que la voiture a été ajoutée ou mise à jour avec succès
    $this->assertNotFalse($result, "La fonction saveCar devrait renvoyer un résultat valide.");

    // Assertion pour vérifier l'ajout d'une nouvelle voiture
    $this->assertGreaterThan(0, $result, "L'ajout d'une nouvelle voiture devrait renvoyer un car_id valide.");

    // Récupération des images associées à la voiture
    $carImages = getPicturesByCarId($pdo, $result);

    // Assertion pour vérifier que des images existent pour la voiture
    $this->assertNotEmpty($carImages, "Des images devraient être associées à la voiture.");

    // Nettoyer : Supprimer la voiture ajoutée ou mise à jour pendant le test
    $this->assertTrue(deleteCar($pdo, $result), "La suppression de la voiture de test devrait réussir.");
}
    }

?>