<?php

require_once __DIR__ . "/lib/config.php";

require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/form.php";
require_once __DIR__ . "/lib/car.php";
require_once __DIR__ . "/lib/session.php";

$mainMenu["forms.php"] = ["head_title" => "contact", "meta_description" => "nous contacter via le formulaire", "exclude" => true];
require_once __DIR__ . "/templates/header.php";


$cars =  getCarsModels($pdo);
$forms = getForms($pdo);
$selectedModel = isset($_GET['model']) ? urldecode($_GET['model']) : '';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = 'Erreur CSRF : tentative de requête non autorisée.';
    }else{
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $surname = htmlspecialchars($_POST["surname"], ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($_POST["mail"], ENT_QUOTES, 'UTF-8');
        $model = htmlspecialchars($_POST["model"], ENT_QUOTES, 'UTF-8');
        $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
        $date = htmlspecialchars($_POST["date"], ENT_QUOTES, 'UTF-8');
        
        // Validation des données
        if (empty($name) || empty($surname) || empty($mail) || empty($model) || empty($subject) || empty($message) || empty($date)) {
            // Au moins un champ obligatoire est vide
            $_SESSION['error_message'] = "Veuillez remplir tous les champs obligatoires.";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            // L'adresse email n'est pas valide
            $_SESSION['error_message'] = "L'adresse email n'est pas valide.";
        } elseif (!strtotime($date)) {
            // La date pas valide
            $_SESSION['error_message'] = "La date n'est pas valide.";
        } else {
            // Requête SQL 
            $sql = "INSERT INTO forms (name, surname, mail, model, subject, message, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $surname, $mail, $model, $subject, $message, $date]);
    
            $_SESSION['thank_you_message'] = "Merci de votre message. Il sera pris en compte dans les meilleurs délais.";
        }
    }

}

if (isset($_SESSION['error_message'])) {
    echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>'; 
    unset($_SESSION['error_message']);
}

$selectedModel = isset($_GET['model']) ? urldecode($_GET['model']) : '';

// depuis le footer model = aucun
if (isset($_GET['from_footer']) && $_GET['from_footer'] == 'yes') {
    $selectedModel = 'Aucun';
}

$csrfToken = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrfToken;
?>

<div class="container">
    <h1> Formulaire du contact </h1>
    <p> Nous prenons le temps de vous lire et de vous répondre dans les meilleurs delais. </p>

    <div class="row">
        <div class="col-md-6 mx-auto ">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <div class="form-group">
                    <label for="name">Votre nom</label>
                    <input class="form-control" type="text"  name="name" id="name" placeholder="votre nom" required>
                </div>
                <div class="form-group">
                    <label for="surname">Votre prénom</label>
                    <input class="form-control" type="text"  name="surname" id="surname" placeholder="votre prénom" required>
                </div>
                <div class="form-group">
                    <label for="mail">Votre email</label>
                    <input class="form-control" type="mail"  name="mail" id="mail" placeholder="votre email" required>
                </div>               
                <div class="form-group">
                    <label for="model">Modèle de voiture</label>
                    <select class="form-control" name="model" id="model" required>
                        <?php foreach ($cars as $carModel) { ?>
                        <option value="<?= htmlentities($carModel); ?>" <?= ($selectedModel == $carModel) ? 'selected' : ''; ?>>
                            <?= $carModel; ?>
                        </option>
                        <?php }; ?>
                        <option value="Aucun" <?= ($selectedModel == 'Aucun') ? 'selected' : ''; ?>>Aucun</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <input class="form-control" type="text"  name="subject" id="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Votre message</label>
                    <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="date" name="date" id="date"/>
                </div>
                <div class= "form-group">
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    <?php
    if (isset($_SESSION['thank_you_message'])) {
        // Utilise JavaScript pour afficher une popup
        echo 'alert("' . $_SESSION['thank_you_message'] . '");';
        unset($_SESSION['thank_you_message']);
    }
    ?>
</script>

<?php
require_once __DIR__ . "/templates/footer.php";
?>