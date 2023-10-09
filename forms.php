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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $mail = $_POST["mail"];
    $model = $_POST["model"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $date = $_POST["date"];
    
    // Validation des données
    if (empty($name) || empty($surname) || empty($mail) || empty($model) || empty($subject) || empty($message) || empty($date)) {
        // Au moins un champ obligatoire est vide
        $_SESSION['error_message'] = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        // L'adresse email n'est pas valide
        $_SESSION['error_message'] = "L'adresse email n'est pas valide.";
    } elseif (!strtotime($date)) {
        // La date n'est pas dans un format attendu
        $_SESSION['error_message'] = "La date n'est pas valide.";
    } else {
        // Requête SQL pour insérer l'avis dans la base de données
        $sql = "INSERT INTO forms (name, surname, mail, model, subject, message, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $surname, $mail, $model, $subject, $message, $date]);

        // Stockez un message de remerciement dans la session
        $_SESSION['thank_you_message'] = "Merci de votre message. Il sera pris en compte dans les meilleurs délais.";

    }
}

// Affichez le message d'erreur s'il est présent dans la session
if (isset($_SESSION['error_message'])) {
    echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
    // Efface le message d'erreur 
    unset($_SESSION['error_message']);
}

?>

<div class="container">
    <h1> Formulaire du contact </h1>
    <p> Nous prenons le temps de vous lire et de vous répondre dans les meilleurs delais. </p>

    <form action= "" method="post">
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
            
            <select class="form-control" name="model" id="model" required>
            <?php foreach ($cars as $carModel) { ?>
                    <option value="<?= htmlentities($carModel); ?>" <?= (isset($_POST['model']) && $_POST['model'] == $carModel) ? 'selected' : ''; ?>>
                        <?= $carModel; ?>
                    </option>
                <?php }; ?>
                <option value="Autres" <?= (isset($_POST['model']) && $_POST['model'] == 'Autres') ? 'selected' : ''; ?>>Autres</option>
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

<script>
    <?php
    if (isset($_SESSION['thank_you_message'])) {
        // Utilisez JavaScript pour afficher une popup
        echo 'alert("' . $_SESSION['thank_you_message'] . '");';
        // Effacez le message de remerciement pour éviter de l'afficher à nouveau
        unset($_SESSION['thank_you_message']);
    }
    ?>
</script>

<?php

require_once __DIR__ . "/templates/footer.php";
?>