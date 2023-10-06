<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";

adminOnly();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par AJAX
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    try {
        $pdo->beginTransaction();

        // Parcourir tous les changements et mettre à jour la base de données
        foreach ($data['changes'] as $change) {
            $sql = "UPDATE openingTimes SET {$change['column']} = :value WHERE openingTime_id = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':value', $change['value'], PDO::PARAM_STR);
            $query->bindParam(':id', $change['id'], PDO::PARAM_INT);
            $query->execute();
        }

        $pdo->commit();
        //réponse Json au client -> mise à jour réussie
       echo json_encode(['status' => 'success', 'message' => 'Mise à jour réussie']);
    } catch (Exception $e) {
        $pdo->rollBack();
         echo json_encode(['status' => 'error', 'message' => 'Erreur PDO : ' . $e->getMessage()]);
    }
} else {
    // Méthode non autorisée
    header('HTTP/1.1 405 Method Not Allowed');
     echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
