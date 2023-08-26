<?php 
require_once __DIR__. "/lib/config.php";
require_once __DIR__. "/lib/session.php";
require_once __DIR__. "/lib/pdo.php";
require_once __DIR__. "/lib/user.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ ."/templates/header.php";

$errors = [];

if (isset($_POST["loginUser"])){
    $email = $_POST["email"];
    var_dump($email);
    $password = $_POST["password"];
    var_dump($password);

    $user = verifyUserLoginPassword($pdo, $email, $password);
    if ($user){
        session_regenerate_id(true); // cree un id de session renouvelé securité en plus
        $_SESSION["user"] = $user;
        if ($user["role_name"] === "employe"){
            header("location: admin/index.php");
        }elseif($user["role_name"] === "administrator"){
            header("location: admin/index.php");
        }
    }else{
        $errors[] = "Email ou mot de passe incorrect";
    }
}




?>
<h1>Login</h1>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger">
        <?=$error; ?>
    </div>
<?php } ?>

<form method="POST">
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


<?php 
require_once __DIR__ ."/templates/footer.php";
?>
