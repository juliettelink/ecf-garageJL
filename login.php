<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/user.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";



$errors = [];

error_reporting(E_ALL);
ini_set('display_errors', 1);

$csrfToken = $_SESSION['csrf_token'];

if (isset($_POST["loginUser"])) {


    //rajouter si l'email n'est pas vide ou le mot de passe


    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = 'Erreur CSRF : tentative de requête non autorisée.';
    }

    $email = $_POST["email"];
    $password = $_POST["password"];


    $user = verifyUserLoginPassword($pdo,$_POST['email'], $_POST['password']);

    if ($user) {
        var_dump("connexion ok");
        // cree un id de session renouvelé, securité en plus
        session_regenerate_id(true);
        $_SESSION["user"] = $user;
        if ($user["role_name"] === "employe" ) {
            header("location: admin/index.php");
        } elseif ($user["role_name"] === "administrator"){
            header("location: admin/index.php"); 
        } else {
            header('location: index.php');
        }
    } else {
    $errors[] = "Email ou mot de passe incorrect";
    }

    var_dump($_POST);
var_dump($csrfToken);
var_dump($user);
}

?>
<div class="container">
    <h1>Login</h1>
    <?php foreach ($errors as $error) {?>
        <div class="alert alert-danger">
            <?=$error;?>
        </div>
    <?php }?>

    <form method="POST">
        <div class="mb-3">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
        </div>
        <div class="m-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="m-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <input type="submit" value="Connexion" name="loginUser" class="btn btn-primary" >
    </form>
</div>

<?php
require_once __DIR__ . "/templates/footer.php";
?>
