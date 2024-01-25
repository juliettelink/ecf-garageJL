<?php

function getAllServices(PDO $pdo):array
{
    $sql = "SELECT * FROM services";
    $query = $pdo->prepare($sql);
    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

function getServiceById(PDO $pdo, int $id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM services WHERE service_id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getServiceImage(string|null $image):string
{
    if ($image === null || $image === "null.jpg"){
    return _DEFAULT_IMAGE_FOLDER_."null.jpg";
} else {
    return _SERVICES_IMAGES_FOLDER_.htmlentities($image);
}
}

//fonction delet service
function deleteService(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM services WHERE service_id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function saveService(PDO $pdo,  string $service, string $description,  string|null $image, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO services (service, description, image) "
        ."VALUES(:service, :description, :image)");
    } else {
        $query = $pdo->prepare("UPDATE `services` SET `service` = :service, "
        ."`description` = :description, "
        ."image = :image WHERE `service_id` = :id;");
        
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':service', $service, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image',$image, pdo::PARAM_STR);
    return $query->execute();  
}