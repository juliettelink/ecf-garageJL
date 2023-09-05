<?php
//function getService(PDO $pdo, int $limit = null, int $page = null):array



function getAllServices(PDO $pdo):array
{
    $sql = "SELECT * FROM services";
    $query = $pdo->prepare($sql);
    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}


function getServiceImage(string|null $image):string
{
    if ($image === null){
    return _ASSETS_IMAGES_FOLDER_."null.jpg";
} else {
    return _SERVICES_IMAGES_FOLDER_.htmlentities($image);
}
}