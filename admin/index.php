<?php 
    require_once __DIR__ . "/../lib/config.php";
    require_once __DIR__ . "/../lib/session.php";
    require_once __DIR__ . "/../lib/pdo.php";
    require_once __DIR__ ."/templates/header.php";

?>
<h1>Bienvenue sur la plateforme</h1>
<p>Chaque employé connecté peut faire des changements sur le site</p>
<ul>
    <li>Ajouter des <U>voitures</U> d'occasions</li>
    <li>Modérer les <U>avis</U> et avec la possibilité d'en ajouter</li>
</ul>

<?php 
    require_once __DIR__ ."/templates/footer.php";
?>