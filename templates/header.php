<?php 
    $mainMenu = [
        "index.php"=> [ "title"=>"Accueil", "head_title"=> "Accueil Garage V.Parrot", "meta_description"=>"Garage V.Parrot, la confiance est notre priorité"],
        "service.php"=> ["title"=>"Nos Services", "head_title"=> "Services Garage V.Parrot","meta_description"=>"Découvrer nos services"],
        "occasion.php"=> ["title"=>"Nos Occasions", "head_title"=> "Occasions Garage V.Parrot","meta_description"=>"Découvrer nos occasions"],
        "opening-time.php"=>["title"=>"Nos Horaires","head_title"=> "Horaires Garage V.Parrot","meta_description"=>"Nos horaires d'ouvertures"],
        
    ];

    $currentPage = basename($_SERVER["SCRIPT_NAME"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $mainMenu[$currentPage]["meta_description"] ?>">
    <title><?= $mainMenu[$currentPage]["head_title"]?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;400&family=Barlow:wght@100&family=Rajdhani:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
    <div class="container">
        <!--navbar-->
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img width="300px" src="assets/images/logo.jpg" alt="logo garage">
                </a>
            </div>

            <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <?php
                    foreach($mainMenu as $key =>$menuItem){?>
                    <li class="nav-item"><a href="<?= $key?>" class="nav-link px-2 <?php 
                        if($key === $currentPage){ echo "active";}
                        ?>"><?=$menuItem["title"]; ?></a></li>
                <?php } ?>
            </ul>
            

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Espace Pro</button>
                <button type="button" class="btn btn-primary">Avis</button>
            </div>
        </header>
        <!--fin navbar-->


        <main>