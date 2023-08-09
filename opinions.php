<?php
require_once __DIR__ . "/lib/opinion.php";
require_once __DIR__ . "/templates/header.php";

?>
<h1>Vos Avis</h1>
<form action= "" method="post">
    <div class="form-group">
        <label for="name">Votre nom</label>
        <input type="name" class="form-control" id="name" placeholder="votre nom">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Votre commentaire</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
