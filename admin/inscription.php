<?php 

require_once __DIR__."/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__."/../lib/pdo.php";
require_once __DIR__."/../lib/user.php";

require_once __DIR__. "/templates/header.php";

adminOnly();

$errors = [];
$messages = [];

if (isset($_POST["addUser"])) {
    // Vérifie si tous les champs du formulaire sont remplis
    if (empty($_POST['mail_id']) || empty($_POST['name']) || empty($_POST['firstname']) || empty($_POST['password'])) {
        $errors[] = 'Tous les champs du formulaire doivent être remplis.';
    } else {
        // Vérifie si l'adresse e-mail est déjà utilisée 
        if (emailAlreadyExists($pdo, $_POST['mail_id'])) {
            $errors[] = 'L\'adresse e-mail est déjà utilisée par un autre utilisateur.';
        }

        // complexité du mot de passe
        if (!isStrongPassword($_POST['password'])) {
            $errors[] = 'Le mot de passe doit contenir au moins une minuscule, une majuscule, un caractère spécial et
                        avoir une longueur minimale de 8 caractères.';
        }

        // ajout de l'utilisateur
        if (empty($errors)) {
            $roleName = 'employe'; 
            $roleId = getRoleIdByName($pdo, $roleName);

            $res = addUser($pdo, $_POST['mail_id'], $_POST['name'], $_POST['firstname'], $_POST['password'], $roleId);
            if ($res) {
                $messages[] = 'Inscription réussie';
            } else {
                $errors[] = 'Une erreur s\'est produite lors de votre inscription.';
            }
        }
    }
}
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
        <input type="email" class="form-control" id="mail_id" name="mail_id" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <input type="submit" name="addUser" class="btn btn-primary" value="Enregistrer" required>
</form>

<?php

require_once __DIR__ ."/templates/footer.php";