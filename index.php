<?php 
    
    require_once __DIR__ . "/lib/car.php";
    require_once __DIR__ .'/lib/menu.php';
    require_once __DIR__ . '/templates/header.php';
    
  
?> 

 
     
     <!-- presentation-->
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
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Horaires</button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">Avis</button>
        </div>
      </div>
    </div>

<!--fin de la bande de persentation-->

      <!-- bloc service-->
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="assets/images/services.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h2 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Nos différents services</h2>
        <p class="lead">De l'entretien courant à la mécanique en passant par les travaux de carrosserie, notre garage
          effectue toutes les prestations nécessaires à la mobilité de votre véhicule:
        </p>
        <p><strong> Entretien et réparation mécanique</strong></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="service.php"  class="btn btn-primary btn-lg px-4 me-md-2">Tous nos services</a>
        </div>
      </div>
    </div>
 <!-- fin du bloc service-->

 <!-- presentation des occasion-->
    <h2>Nos occasions</h2>

    <div class="row text-center ">
      <?php foreach($cars as $key => $car){ 
        require __DIR__ . "/templates/part_car.php";  
      }?>
    </div>
    <a href="occasion.php" class="btn btn-primary">Nos occasions</a>
    
    


 <!--fin de la présentation des occasions-->

 <!-- les avis-->

 <article>
  <h2>les avis à mettre faire un slider</h2>
  <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <div class="container">
         <div class="carousel-caption">
            <h1>Example headline.</h1>
            <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>c'est celui la que je veux
            </p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</article>


<?php 
  require_once __DIR__ . '/templates/footer.php';
?>
