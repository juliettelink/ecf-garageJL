<?php 
    require_once __DIR__ ."/../../lib/config.php";
    require_once __DIR__ ."/../../lib/session.php";

   // adminOnly();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/override-bootstrap.css">  
    <link rel="stylesheet" href="../assets/css/styles.css">
    
</head>
<body>

    <div class="container d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Garage V.Parrot</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <i class="fa-solid fa-arrow-right-to-bracket fa-sm me-2" style="color: #ffffff;"></i> 
                    Création de compte
                </a>
            </li>
            <li>
                <a href="cars.php" class="nav-link text-white">
                    <i class="fa-solid fa-car fa-sm me-2" style="color: #ffffff;"></i>
                    Voitures
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <i class="fa-solid fa-gauge fa-sm me-2" style="color: #ffffff;"></i>
                    Services
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <i class="fa-solid fa-pen-to-square fa-sm me-2" style="color: #ffffff;"></i>
                    Avis
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <i class="fa-solid fa-calendar-days fa-sm me-2" style="color: #ffffff;"></i>
                    Horaires
                </a>
            </li>
            </ul>
            <hr>
            <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>
    <div>
        <main class="d-flex flex-column px-4">