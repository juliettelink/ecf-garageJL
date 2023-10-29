document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('openingTimesTable');
    const submitButton = document.getElementById('submitChanges');

    // Ajoute un écouteur d'événement sur le clic du bouton d'enregistrement
    submitButton.addEventListener('click', function () {
        const changes = [];

        // Parcourt toutes les cellules éditables et collecter les changements
        table.querySelectorAll('.editable').forEach(function (cell) {
            const id = cell.getAttribute('data-id');
            const column = cell.getAttribute('data-column');
            const value = cell.innerText;

            changes.push({ id, column, value });
        });

        // Envoye les modifications au serveur via fetch
        fetch('time.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ changes }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Mise à jour réussie !');
            } else {
                alert('Erreur lors de la mise à jour : ' + data.message);
            }
        })
        .catch(error => {
            alert('Erreur lors de la requête fetch : ' + error.message);
        });
    });
});
