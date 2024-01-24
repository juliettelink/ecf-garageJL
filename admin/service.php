<?php

require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/service.php";
require_once __DIR__ . "/templates/header.php";



$errors = [];
$messages = [];
$service = [
    'service' => '',
    'description' => '',
];


if (isset($_GET['id'])) {
    //requête pour récupérer les données du service en cas de modification
    $service = getServiceById($pdo, $_GET['id']);
    
    if ($service === null) {
        $errors[] = "Le service n\'existe pas";
    }
    $pageTitle = "Formulaire de modification du service";
} else {
    $pageTitle = "Formulaire ajout du service";
}


if (isset($_POST['saveService'])) {

    // Validation pour s'assurer que le champ 'service' n'est pas vide
    if (empty($_POST['service'])) {
        $errors[] = "Le champ 'Nom du service' ne peut pas être vide.";
    }

    // Validation pour s'assurer que le champ 'description' n'est pas vide
    if (empty($_POST['description'])) {
        $errors[] = "Le champ 'Description' ne peut pas être vide.";
    }
    // Gestion de l'image
    $fileName = null;

    // Si aucun fichier n'a été envoyé
    if (empty($_FILES["file"]["tmp_name"]) && !isset($_GET['id'])) {
        // Si c'est une création et aucun fichier image
        $fileName = 'default_image.jpg';
    } elseif (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
    
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            // On déplace le fichier uploadé dans notre dossier
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _SERVICES_IMAGES_FOLDER_ . $fileName)) {
                // L'image a été téléchargée avec succès
                // Suppression de l'ancienne image si on modifie le service
                if (isset($_POST['image']) && isset($_GET['id'])) {
                    unlink(dirname(__DIR__) . _SERVICES_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } 

    $service = [
        'service' => $_POST['service'],
        'description' => $_POST['description'],
        'image' => $fileName  
    ];

    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // On passe toutes les données à la fonction 
        $res = saveService($pdo, $_POST["service"], $_POST["description"], $fileName, $id);

        if ($res) {
            $messages[] = "Le service a bien été sauvegardé";
            //On vide le tableau pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $service = [
                    'service' => '',
                    'description' => '',
                ];
            }
        } else {
            $errors[] = "Le service n'a pas été sauvegardé";
        }
    }
}

?>
<h1><?= $pageTitle; ?></h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>
<?php if ($service !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="service" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="service" name="service" value="<?= $service['service']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= $service['description']; ?></textarea>
        </div>
        <?php if (isset($_GET['id']) && isset($service['image'])) { ?>
            <p>
                <img src="<?= _SERVICES_IMAGES_FOLDER_ . $service['image'] ?>" alt="<?= $service['service'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $service['image']; ?>">

            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>

        <input type="submit" name="saveService" class="btn btn-primary" value="Enregistrer">

    </form>

<?php } ?>



<?php require_once __DIR__ . "/templates/footer.php"; ?>
