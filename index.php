<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";

require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/lib/car.php";

require_once __DIR__ . "/lib/opinion.php";
require_once __DIR__ . "/templates/header.php";

$cars = getCars($pdo, _HOME_CARS_LIMIT_);

?>
<div class="container">
      <!-- presentation-->
    <section classe="presentation">
      <div class="row flex-lg-row align-items-center g-5 py-5">
        <div class= "presentation col-10 col-sm-8 col-lg-6">
          <img src="assets/images/presentation.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
          <div class="slogan">
            <p>
              <img src="assets/images/icone-logo-gauche.jpg" alt="image icone logo gauche" width="60px">
              La confiance est notre priorité !
              <img src="assets/images/icone-logo-droit.jpg" alt="image icone logo droit" width="60px">
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Bienvenue au Garage V.Parrot</h1>
          <p class="lead">Vincent Parrot, fort de ses 15 années d'expérience dans la réparation automobile.
            Le garage V.Parrot s'est ouvert en 2021.<br>
            Large gamme de services: réparation de la carrosserie, de la mécanique, entretien régulier
            et ventes de véhicules d'occasion.
          </p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="#footer" class="btn btn-primary btn-lg px-4 me-md-2">Horaires</a>
          </div>
        </div>
      </div>
    </section>

<!--fin de la bande de persentation-->

      <!-- bloc service-->
    <section classe="service">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="assets/images/services.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
          <h2 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Nos différents services</h2>
          <p class="lead">De l'entretien courant à la mécanique en passant par les travaux de carrosserie, notre garage
            effectue toutes les prestations nécessaires à la mobilité de votre véhicule:
          </p>
          <ul class="two_columns">
            <li>Climatisation</li>
            <li>Vidange</li>
            <li>Carroserie et tôlerie</li>
            <li>Distribution</li>
            <li>Vitrage et phare</li>
          </ul>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="services.php"  class="btn btn-primary btn-lg px-4 me-md-2">Tous nos services</a>
          </div>
        </div>
      </div>
    </section>
 <!-- fin du bloc service-->

 <!-- presentation des occasion-->
  <section classe="occasion">
    <h2 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 ">Nos occasions</h2>

    <div class="row text-center ">
      <?php foreach ($cars as $key => $car) {
  require __DIR__ . "/templates/part_car.php";
}?>
    </div>
    <a href="occasions.php" class="btn btn-primary">Nos occasions</a>
  </section>




 <!--fin de la présentation des occasions-->

 <!-- carrousel des avis-->

 <article classe="opinion">
    <div id="myCarousel" class="carousel slide mt-5" data-bs-ride="carousel" data-bs-theme="light">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="25%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
          <div class="container">
            <div class="carousel-caption">
              <h3>Les Avis</h3>
              <p>Lisez les avis clients et mettez votre ressentis</p>
            </div>
          </div>
        </div>
      <?php 
        $recentOpinion = getRecentOpinions($pdo);
        foreach ($recentOpinion as $key => $opinion) {
        require __DIR__ . "/templates/part_opinion.php";
      }?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>  
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>  
      </button>
    </div>
    <div>
      <a href="opinions.php" type="button" class="btn btn-primary">Donner votre avis</a>
    </div>
  </article>

</div>





<?php
require_once __DIR__ . '/templates/footer.php';
?>
