<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";


adminOnly();

?>
<h1>essai</h1>
<?php


header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par AJAX
    $json = file_get_contents('php://input');
    $changes = json_decode($json, true);

    try {
        $pdo->beginTransaction();
        // Bouclez à travers les changements et mettez à jour la base de données
        foreach ($changes as $id => $columns) {
            foreach ($columns as $column => $value) {
                $sql = "UPDATE openingTimes SET $column = :value WHERE openingTime_id = :id";
                $query = $pdo->prepare($sql);
                $query->bindParam(':value', $value, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                

                 // Ajoutez des var_dump pour déboguer
        var_dump($sql);
        var_dump($value);
        var_dump($id);

        if (!$query->execute()) {
            // Vérifiez les erreurs d'exécution de la requête SQL
            echo json_encode(['status' => 'error', 'message' => 'Erreur d\'exécution de la requête SQL: ' . print_r($query->errorInfo(), true)]);
            exit;
        }
            }
        }

        $pdo->commit(); // Valider la transaction

         // Envoie une réponse JSON indiquant le succès
         echo json_encode(['status' => 'success', 'message' => 'Mise à jour réussie']);
        
    } catch (Exception $e) {
        $pdo->rollBack(); // Annuler la transaction en cas d'erreur
       
        echo json_encode(['status' => 'error', 'message' => 'Erreur PDO : ' . $e->getMessage()]);
    }
} else {
    // Gérer les autres méthodes de requête ou rediriger
    //header('Location: OpeningTimes.php');
}
?>
