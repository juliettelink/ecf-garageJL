<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/opinion.php";

$mainMenu["opinions.php"] = ["head_title" => "vos avis", "meta_description" => "espace pour donner son avis sur le garage", "exclude" => true];
require_once __DIR__ . "/templates/header.php";

$opinions = getOpinions($pdo);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameClient = $_POST["nameClient"];
    $comment = $_POST["comment"];
    $date = $_POST["date"];
    $note = $_POST["note"];
       // Validation des données (assurez-vous de faire cela)

    // Requête SQL pour insérer l'avis dans la base de données
    $sql = "INSERT INTO opinions (nameClient, comment, date, note) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nameClient, $comment, $date, $note]);

    // Redirection vers la page d'avis après l'ajout
    header("Location: opinions.php");
    exit();
}
?>

<h1>Vos Avis</h1>
<form action= "" method="post">
    <div class="form-group">
        <label for="nameClient">Votre nom</label>
        <input class="form-control" type="text"  name="nameClient" id="nameClient" placeholder="votre nom">
    </div>
    <div class="form-group">
        <label for="comment">Votre commentaire</label>
        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input class="form-control" type="date" name="date" id="date"/>
    </div>


    <div class= "form-group">
        <ul class="rating">
            <li class="lar la-star" data-value="1"></li>
            <li class="lar la-star" data-value="2"></li>
            <li class="lar la-star" data-value="3"></li>
            <li class="lar la-star" data-value="4"></li>
            <li class="lar la-star" data-value="5"></li>
        </ul>
        <input type="hidden" name="note" id="note" value="0">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
</form>


<?php

require_once __DIR__ . "/templates/footer.php";
?>
