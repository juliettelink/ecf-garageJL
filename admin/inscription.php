<?php 

require_once __DIR__."/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__."/../lib/pdo.php";
require_once __DIR__."/../lib/user.php";

require_once __DIR__. "/templates/header.php";

adminOnly();

$errors = [];
$messages = [];

if (isset($_POST["addUser"])){

    //faire verif sur les champs en plus
    // pas le meme email que dans la base de donnée
    // mot de passe avec maj min et caracter special

    $res = addUser($pdo, $_POST['mail_id'], $_POST['name'], $_POST['firstname'], $_POST['password']);
    if ($res) {
        $messages[] = 'Inscription réussie';
    } else {
        $errors[] = 'Une erreur s\'est produite lors de votre inscription';
    }
}
var_dump($_POST)

?>

<h1 class="py-3">Inscription employé</h1>

<?php foreach ($messages as $message){ ?>
    <div class="alert alert-success" role="alert">
<?= $message; ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error){ ?>
    <div class="alert alert-danger" role="alert">
<?= $error; ?>
    </div>
<?php } ?>


<form method="POST">
    <div class="mb-3">
        <label for="mail_id" class="form-label">Email</label>
        <input type="email" class="form-control" id="mail_id" name="mail_id">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <input type="submit" name="addUser" class="btn btn-primary" value="Enregistrer">
</form>

<?php

require_once __DIR__ ."/templates/footer.php";