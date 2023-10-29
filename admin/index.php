<?php 
    require_once __DIR__ . "/../lib/config.php";
    require_once __DIR__ . "/../lib/session.php";
    require_once __DIR__ . "/../lib/pdo.php";
    require_once __DIR__ ."/templates/header.php";

?>
<div class="text-center">
    <a href="../index.php" type="button" class="btn btn-outline-primary  col-8 " alt="retour au site">Retour sur le site</a>
</div>

<h1 class="mt-4 text-center">Bienvenue sur la plateforme</h1>

<p class="text-center">Chaque employé connecté peut faire des changements sur le site : </p>
<ul>
    <li>Dans l'espace <B>Voitures</B> : ajoute, supprime ou modifie un modéle. </li>
    <li>Dans l'espace <B>Avis</B> : ajoute , supprime ou modifie un avis.</li>
    <li>Dans l'espace <B>Message Clients</B> : supprime un message.</li>
</ul>


<?php 
    require_once __DIR__ ."/templates/footer.php";
?>