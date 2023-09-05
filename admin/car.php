<?php

require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";

// category pas sur pour categorie
require_once __DIR__ . "/../lib/car.php";
require_once __DIR__ . "/templates/header.php";

$errors = [];
$messages = [];
$car = [
    'model' => '',
    'year' => '',
    'price' => '',
    'kilometer' => '',
    'full' => '',
    'color' => '',
    'image1' => '',
    'image2' => '',
    'image3'=> '',
];


if (isset($_GET['id'])) {
    // pour récupérer les données de la voiture si modif
    $car = getCarById($pdo, $_GET['id']);
    if ($car === false) {
        $errors[] = "l'article n'exite pas";
    }
    $pageTitle = "Formulaire modification de voiture";
} else {
    $pageTitle = "Formulaire ajout de voiture";
}

// A VERIFIER A PARTIR DE LA C DU COPIER COLLER

if (isset($_POST['saveCar'])) {
//@todo gérer la gestion des erreurs sur les champs (champ vide etc.)

    $fileName = null;
// Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__)
            permet de cibler le dossier parent car on se trouve dans admin
             */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _CARS_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image1'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__) . _CARS_IMAGES_FOLDER_ . $_POST['image1']);
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
                unlink(dirname(__DIR__) . _CARS_IMAGES_FOLDER_ . $_POST['image1']);
            } else {
                $fileName = $_POST['image1'];
            }
        }
    }
/* On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
les informations dans les champs. C'est utile pas exemple si on upload un mauvais
fichier et qu'on ne souhaite pas perdre les données qu'on avait saisit.
 */
    $car = [
        'model' => $_POST['model'],
        'year' => $_POST['year'],
        'price' => $_POST['price'],
        'kilometer' => $_POST['kilometer'],
        'full' => $_POST['full'],
        'color' => $_POST['color'],
        'image1' => $_POST['image1'],
        'image2' => $_POST['image2'],
        'image3' => $_POST['image3']
    ];

    var_dump($_POST['year']);
    
// Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int) $_GET["id"];
        } else {
            $id = null;
        }
        var_dump($_POST['color']);
        // On passe toutes les données à la fonction saveArticle
        $res = saveCar($pdo, $_POST["model"], $_POST["year"], $_POST["price"], $_POST["kilometer"],$_POST["full"], $_POST["color"], $_POST["image1"],
        $_POST["image2"],$_POST["image3"], $id);
       
        if ($res) {
            $messages[] = "L'article a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $car = [
                    'model' => '',
                    'year' => '',
                    'price' => '',
                    'kilometer' => '',
                    'full' => '',
                    'color' => '',
                    'image1' => '',
                    'image2' => '',
                    'image3' => '',
                ];
            }
        } else {
            $errors[] = "L'article n'a pas été sauvegardé";
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
            <input type="text" class="form-control" id="model" name="model" value="<?= $car['model']; ?>">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Année</label>
            <input type="number" class="form-control" id="year" name="year" value="<?= $car['year']; ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= $car['price']; ?>">
        </div>
        <div class="mb-3">
            <label for="kilometer" class="form-label">Kilométre</label>
            <input type="text" class="form-control" id="kilometer" name="kilometer" value="<?= $car['kilometer']; ?>">
        </div>
        <div class="mb-3">
            <label for="full" class="form-label">Carburant</label>
            <input type="text" class="form-control" id="full" name="full" value="<?= $car['full']; ?>">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Couleur</label>
            <input type="text" class="form-control" id="color" name="color" value="<?= $car['color']; ?>">
        </div>
        
        <?php for ($i = 1; $i <= 3; $i++){?>
            <?php if (isset($_GET['id']) && isset($car['image' . $i])) { ?>
                <p>
                    <img src="<?= _CARS_IMAGES_FOLDER_ . $car['image' . $i] ?>" alt="<?= $car['model'] ?>" width="100">
                    <label for="delete_image<?= $i?>">Supprimer l'image</label>
                    <input type="checkbox" name="delete_image<?= $i?>" id="delete_image<?= $i?>">
                    <input type="hidden" name="image<?= $i ?>" value="<?= $car['image' . $i]; ?>">


                </p>
            <?php } ?>
        <?php } ?>


        <p>
            <input type="file" name="file" id="file">
        </p>

        <input type="submit" name="saveCar" class="btn btn-primary" value="Enregistrer">

    </form>

<?php } ?>



<?php require_once __DIR__ . "/templates/footer.php"; ?>
