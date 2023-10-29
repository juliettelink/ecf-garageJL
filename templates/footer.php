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
                <a href="forms.php" type="button" class="btn btn-primary">Nous contacter</a> <br><br>
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
                            <th scope="row"><?php echo htmlentities($openingTime['day']); ?></th>
                            <td><?php echo htmlentities($openingTime['morningOpen']); ?></td>
                            <td><?php echo htmlentities($openingTime['morningClose']); ?></td>
                            <td><?php echo htmlentities($openingTime['afternoonOpen']); ?></td>
                            <td><?php echo htmlentities($openingTime['afternoonClose']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class= "d-flex flex-wrap justify-content-between">
            <span class="mb-3 mb-md-0 text-body-secondary ">© 2021 Garage V.Parrot, Inc</span>
            <ul class="nav col-md-4 list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="index.php">Accueil</a></li>
                <li class="ms-3"><a class="text-body-secondary" href="services.php">Services</a></li>
                <li class="ms-3"><a class="text-body-secondary" href="occasions.php">Occasions</a></li>
            </ul>
        </div>
    </footer>
</div>

<!-- cdn jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- cdn bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- script JS -->
<script src="filterScript.js"></script>
<script src="opinionScript.js"></script>

</body>
</html>

