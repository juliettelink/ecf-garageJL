<?php
// $opinions = [
//  ["nameClient" => "Jeanne Boulin", "comment" => "Service rapide et efficace, je recommande", "note" => "5"],
//  ["nameClient" => "Pierre Rondin", "comment" => "Je suis tombé au mauvias moment, il y avait beaucoup d'attente, mais ils ont su me faire pacienté avec un petit café", "note" => "4"],
//  ["nameClient" => "Sandrine Chalin", "comment" => "J'ai acheté une voiture d'occasion, je suis très satisfaite", "note" => "5"],
//  ["nameClient" => "Jean Rrucj", "comment" => "Très professionnel et d'une grande humanité", "note" => "4"],
// ];


function getOpinions(PDO $pdo){
    $sql = "SELECT * FROM opinions";
    $stmt = $pdo->query($sql);

    $opinions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $opinions;
}

function getRecentOpinions($pdo){
    $sql = "SELECT * FROM opinions ORDER BY opinion_id DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $recentOpinions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $recentOpinions; 
}