<?php 
require_once __DIR__. "/lib/config.php";
require_once __DIR__. "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ ."/templates/header.php";


if (isset($_POST["loginUser"])){
    $email = $_POST["email"];
    var_dump($email);
    $password = $_POST["password"];
    
    $query = $pdo->prepare("SELECT *
                            FROM users u
                            WHERE mail_id = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user["password"])){
        var_dump("connexion ok");
    
    }else{
        //login ou mot de passe incorrect
        var_dump("mot de passe ou login incorrect");
    }
    var_dump($user);

}




?>
<h1>Login</h1>
<form methode="post">
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
