document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('openingTimesTable');
    const submitButton = document.getElementById('submitChanges');

    // Ajouter un écouteur d'événement sur le clic du bouton d'enregistrement
    submitButton.addEventListener('click', function () {
        const changes = [];

        // Parcourir toutes les cellules éditables et collecter les changements
        table.querySelectorAll('.editable').forEach(function (cell) {
            const id = cell.getAttribute('data-id');
            const column = cell.getAttribute('data-column');
            const value = cell.innerText;

            changes.push({ id, column, value });
        });

        // Envoyer les modifications au serveur via fetch
        fetch('time.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ changes }),
        })
        .then(response => response.json())
        .then(data => {
            // Afficher la réponse du serveur dans la console du navigateur
            //console.log('Réponse du serveur :', data);
            if (data.status === 'success') {
                //console.log('Mise à jour réussie !', data.message);
                alert('Mise à jour réussie !');
            } else {
                //console.error('Erreur lors de la mise à jour', data.message);
                alert('Erreur lors de la mise à jour : ' + data.message);
            }
        })
        .catch(error => {
            //console.error('Erreur lors de la requête fetch :', error);
            alert('Erreur lors de la requête fetch : ' + error.message);
        });
    });
});
