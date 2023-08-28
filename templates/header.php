<?php 
    require_once __DIR__. "/../lib/session.php";
    require_once __DIR__ . '/../lib/menu.php';
    $currentPage = basename($_SERVER["SCRIPT_NAME"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$mainMenu[$currentPage]["meta_description"] ?>">
    <title><?= $mainMenu[$currentPage]["head_title"]?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;400&family=Barlow:wght@100&family=Rajdhani:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

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
                    foreach($mainMenu as $key => $menuItem){
                        if(!array_key_exists("exclude", $menuItem)){
                        ?>
                    <li class="nav-item"><a href="<?= $key?>" class="nav-link px-2 <?php 
                        if($key === $currentPage){ echo "active";}
                        ?>"><?=$menuItem["menu_title"]; ?></a></li>
                <?php }
                } 
                ?>
            </ul>
            

            <div class="col-md-3 text-end">
                <?php if(isset($_SESSION["user"])){ ?>
                    <a href= "logout.php" type= "button" class="btn btn-outline-primary me-2">Déconnexion</a>
                <?php } else{?>
                    <a href="login.php" type="button" class="btn btn-outline-primary me-2">Espace Pro</a>
                <?php } ?>
                
                <a href="opinions.php" type="button" class="btn btn-primary">Avis</a>
            </div>
        </header>
        <!--fin navbar-->


        <main>