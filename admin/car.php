<?php

require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";

require_once __DIR__ . "/../lib/car.php";
require_once __DIR__ . "/templates/header.php";

employeAndAdmin();


$errors = [];
$messages = [];
$car = [
    'model' => '',
    'year' => '',
    'price' => '',
    'kilometer' => '',
    'full' => '',
    'color'=> ''
];


if (isset($_GET['id'])) {
    //requête pour récupérer les données de l'article en cas de modification
    $car = getCarById($pdo, $_GET['id']);
  
    if ($car === false) {
        $errors[] = "La voiture n\'existe pas";
    }
    $pageTitle = "Formulaire de modification de la voiture";
} else {
    $pageTitle = "Formulaire d'ajout de la voiture";
}

if (isset($_POST['saveCar'])) {

    if (empty($_POST['model']) || !is_string($_POST['model'])) {
        $errors[] = "Le champ 'Modèle' ne peut pas être vide et doit être une chaine de caractères";
    }
    if (empty($_POST['year']) || !is_numeric($_POST['year'])) {
        $errors[] = "Le champ 'Année' ne peut pas être vide  et doit être un nombre.";
    }
    if (empty($_POST['price']) || !is_numeric($_POST['price'])) {
        $errors[] = "Le champ 'Prix' ne peut pas être vide et doit être un nombre.";
    }
    if (empty($_POST['kilometer']) || !is_numeric($_POST['kilometer'])) {
        $errors[] = "Le champ 'Kilométre' ne peut pas être vide et doit être un nombre";
    }
    if (empty($_POST['full']) || !is_string($_POST['full'])) {
        $errors[] = "Le champ 'Carburant' ne peut pas être vide et doit être une chaine de caractères.";
    }
    if (empty($_POST['color']) || !is_string($_POST['color'])) {
        $errors[] = "Le champ 'Couleur' ne peut pas être vide et doit être une chaine de caractères.";
    }
    
    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        // Vérification du type de fichier
        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $imageType = exif_imagetype($_FILES["file"]["tmp_name"]);

        if (!in_array($imageType, $allowedTypes)) {
            $errors[] = 'Le fichier doit être une image valide (JPEG, PNG, GIF)';
        }

        //  taille du fichier
        $maxFileSize = 5 * 1024 * 1024; // 5 Mo
        if ($_FILES["file"]["size"] > $maxFileSize) {
            $errors[] = 'Le fichier est trop volumineux. La taille maximale autorisée est de 5 Mo.';
        }

        // enregistrement du fichier
        if (empty($errors)) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__)._CARS_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image1']) && $_POST['image1'] !== 'null.jpg') {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__)._CARS_IMAGES_FOLDER_ . $_POST['image1']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        // Si aucun fichier n'a été envoyé
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // Si on a coché la case de suppression d'image, on supprime l'image
                $imageToDelete = dirname(__DIR__) . _CARS_IMAGES_FOLDER_ . $_POST['image1'];
                if (file_exists($imageToDelete)) {
                    unlink($imageToDelete);
                } else {
                    // Si le fichier n'existe pas, utilisez la valeur par défaut
                    $fileName = 'null.jpg';
                }
            } else {
                $fileName = $_POST['image1'];
            }
        } else {
            // Si aucun fichier n'a été envoyé et il n'y a pas d'id, utilisez la valeur par défaut
            $fileName = 'null.jpg';
        }
    }
    /* On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
       les informations dans les champs.
    */
    $car = [
        'model' => $_POST['model'],
        'year' => $_POST['year'],
        'price' => $_POST['price'],
        'kilometer' => $_POST['kilometer'],
        'full' => $_POST['full'],
        'color' => $_POST['color'],
        'image1' => $fileName
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
        $res = saveCar($pdo, $_POST["model"], $_POST["year"], $_POST["price"], $_POST["kilometer"], $_POST["full"], $_POST["color"], $fileName, $id);

        if ($res) {
            $messages[] = "La voiture a bien été sauvegardée";
            //On vide le tableau pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $car = [
                    'model' => '',
                    'year' => '',
                    'price' => '',
                    'kilometer' => '',
                    'full' => '',
                    'color'=> ''
                ];
            }
            //reinitialise les messages
           //$messages = [];
           // $errors = [];
        } else {
            $errors[] = "La voiture n'a pas été sauvegardé";
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

<?php if ($car !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
            <label for="model" class="form-label">Modéle</label>
            <input type="text" class="form-control" id="model" name="model" value="<?= $car['model']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Année</label>
            <input type="number" class="form-control" id="year" name="year" value="<?= $car['year']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $car['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kilometer" class="form-label">Kilométre</label>
            <input type="text" class="form-control" id="kilometer" name="kilometer" value="<?= $car['kilometer']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="full" class="form-label">Carburant</label>
            <input type="text" class="form-control" id="full" name="full" value="<?= $car['full']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Couleur</label>
            <input type="text" class="form-control" id="color" name="color" value="<?= $car['color']; ?>" required>
        </div>

        <?php if (isset($_GET['id']) && isset($car['image1'])) { ?>
            <p>
                <img src="<?= "../uploads/occasion/". $car['image1'] ?>" alt="<?= $car['model'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image1" value="<?= $car['image1']; ?>">
            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>
        <input type="submit" name="saveCar" class="btn btn-primary" value="Enregistrer">
    </form>

<?php } ?>



<?php require_once __DIR__ . "/templates/footer.php"; ?>