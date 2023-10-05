document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('openingTimesTable');
    const changes = {};  // Un objet pour stocker les modifications

    console.log('Changements à envoyer:', changes);

    table.addEventListener('blur', function (event) {
        const target = event.target;


             // Ajoutez un message de débogage pour vérifier que l'événement est bien déclenché
     console.log('Blur sur la cellule :', target);

        // Vérifier si l'élément édité est une cellule éditable
        if (target.classList.contains('editable')) {
            // Mettez à jour les modifications dans la structure de données
            const id = target.getAttribute('data-id');
            const column = target.getAttribute('data-column');
            const value = target.innerText;

            if (!changes[id]) {
                changes[id] = {};
            }

            changes[id][column] = value;
        }
    });

    // Ajoutez un gestionnaire de clic pour le bouton d'enregistrement
    const submitButton = document.getElementById('submitChanges');
    submitButton.addEventListener('click', function () {

                // Ajoutez un message de débogage pour vérifier que le clic est bien détecté
    console.log('Clic sur le bouton d\'enregistrement');

        // Envoyer les modifications au serveur via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'time.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');  // Utilisez JSON pour envoyer des données

        // Ajoutez ici pour voir ce qui est envoyé au serveur
        console.log('Envoyé au serveur :', JSON.stringify(changes));

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                // Ajoutez ici pour voir la réponse du serveur
                console.log('Réponse complète du serveur :', xhr);
                console.log('Réponse du serveur :', xhr.responseText);
                
                if (xhr.status === 200) {
                    console.log('Mise à jour réussie !');
                } else {
                    console.error('Erreur lors de la mise à jour', xhr.status, xhr.statusText);
                }
            }
        };

        

        // Convertissez l'objet changes en JSON et envoyez-le
        const data = JSON.stringify(changes);
        xhr.send(data);

        console.log('Envoyé au serveur :', data);
    });
});
