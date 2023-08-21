<?php 
require __DIR__ . "/lib/menu.php";
require __DIR__ ."/templates/header.php";

?>
<h1>Login</h1>
<form methode="post">
    <div class="m-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="m-3">
        <label class="form-label" for="passeword">Mot de passe</label>
        <input type="passeword" name="passeword" id="passeword" class="form-control">
    </div>

    <input type="submit" value="Connexion" name="loginUser" class="btn btn-primary" >
</form>


<?php 
require __DIR__ ."/templates/footer.php";
?>
