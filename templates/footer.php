<?php
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . '/../lib/openingTimes.php';

$openingTimes = getOpeningTimes($pdo);

?>
</main>
<div class="container">
    <footer id="footer" class=" footer py-3 my-4 border-top">

        <div class="d-flex flex-wrap justify-content-around  align-items-center">
            <div>
                <h4> Garage V.Parrot</h4>
                <p> 
                14 rue de la Laque <br>
                31000 TOULOUSE<br>
                tel : 05 26 25 25 14<br>
                </p> 
                <a href="forms.php?from_footer=yes" type="button" class="btn btn-primary">Nous contacter</a> <br><br>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.3392406334306!2d1.432110718476082!3d43.599477720117605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aebb7aefd7b523%3A0xc9a63f739559ae58!2s14%20Rue%20de%20la%20Laque%2C%2031300%20Toulouse!5e0!3m2!1sfr!2sfr!4v1695035508196!5m2!1sfr!2sfr" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div>
            <h4> Nos horaires</h4>
                <table class="table table-striped ">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">Jours</th>
                            <th scope="col">debut matin</th>
                            <th scope="col">fin matin</th>
                            <th scope="col">debut ap</th>
                            <th scope="col">fin ap</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php foreach ($openingTimes as $openingTime){ ?>
                        <tr>
                            <th scope="row"><?= htmlentities($openingTime['day']); ?></th>
                            <td><?= htmlentities($openingTime['morningOpen']); ?></td>
                            <td><?= htmlentities($openingTime['morningClose']); ?></td>
                            <td><?= htmlentities($openingTime['afternoonOpen']); ?></td>
                            <td><?= htmlentities($openingTime['afternoonClose']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class= "d-flex flex-wrap justify-content-between">
            <span class="mb-3 mb-md-0 text-body-secondary ">© 2021 Garage V.Parrot, Inc</span>
            <ul class="nav col-md-4 list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="#" id="privacy-policy-link">Politique de confidentialité</a></li> 
                <li class="ms-3"><a class="text-body-secondary" href="index.php">Accueil</a></li>
                <li class="ms-3"><a class="text-body-secondary" href="services.php">Services</a></li>
                <li class="ms-3"><a class="text-body-secondary" href="occasions.php">Occasions</a></li>
            </ul>
        </div>
    </footer>
</div>

<!-- Contenu de la politique de confidentialité -->
<div id="privacy-policy-popup">
    <h2>Votre politique de confidentialité </h2>
    <div class="overflow-auto" style="max-height: 300px;">
        <p> Dernière mise à jour : 10/2023
            Bienvenue sur notre site exploitant le garage VParrot. Nous nous engageons à protéger la confidentialité de vos informations. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations lorsque vous utilisez notre site et notamment lorsque vous faites des demandes d'informations sur des voitures d'occasion spécifiques via notre formulaire de contact.
            Informations que nous collectons :
            Lorsque vous utilisez notre formulaire de contact pour demander des informations sur une voiture d'occasion spécifique, nous collectons les informations que vous fournissez volontairement, telles que votre nom, votre adresse e-mail et votre numéro de téléphone.
            Finalité de la collecte :
            Les informations collectées sont utilisées exclusivement pour répondre à votre demande d'informations sur la voiture d'occasion spécifique que vous avez mentionnée dans le formulaire.
            Utilisation des informations :
            Nous utilisons les informations que vous fournissez pour vous fournir les détails demandés sur la voiture d'occasion spécifique et pour faciliter la communication relative à votre demande.
            Conservation des données :
            Les informations fournies dans le cadre de votre demande sont conservées pendant six mois à des fins de suivi et de communication ultérieure.
            Communication additionnelle :
            En fournissant vos informations, vous consentez à recevoir des communications additionnelles de notre part, notamment des mises à jour sur de nouvelles arrivées de voitures d'occasion et des offres promotionnelles.
            Sécurité des informations :
            Nous prenons des mesures de sécurité appropriées pour protéger vos informations, y compris des technologies de sécurité et des pratiques de gestion sécurisées.
            Partage d'informations :
            Nous ne partageons pas vos informations avec des tiers sans votre consentement, sauf si cela est nécessaire pour répondre à votre demande spécifique (par exemple, pour fournir un rapport d'historique de véhicule).
            En utilisant notre site et en fournissant vos informations, vous consentez à notre politique de confidentialité. Nous nous réservons le droit de mettre à jour cette politique de confidentialité à tout moment. Veuillez consulter cette page régulièrement pour être informé des éventuelles modifications.
            Si vous avez des questions ou des préoccupations concernant notre politique de confidentialité, veuillez nous contacter.
        </p>
    </div>
    <button id="close-popup">Fermer</button>
</div>

<!-- cdn jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- cdn bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- script JS -->
<script src="./assets/js/filterScript.js"></script>
<script src="./assets/js/opinionScript.js"></script>
<script src="./assets/js/private_politicy.js"></script>
<script src="./assets/js/passwordVisibility.js"></script>

</body>
</html>

