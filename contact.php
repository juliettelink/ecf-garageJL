<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/opinion.php";

$mainMenu["contact.php"] = ["head_title" => "contact", "meta_description" => "nous contacter via le formulaire", "exclude" => true];
require_once __DIR__ . "/templates/header.php";
?>




<?php

require_once __DIR__ . "/templates/footer.php";
?>