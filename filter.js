
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('filter-form').addEventListener('submit', handleFormSubmit);
});


// Fonction pour gérer la soumission du formulaire
function handleFormSubmit(event) {
    event.preventDefault();

    // Récupérer les valeurs des filtres
    const year = document.getElementById('year').value;
    const price = document.getElementById('price').value;
    const kilometer = document.getElementById('kilometer').value;

    // Effectuer la requête AJAX
    sendAjaxRequest(year, price, kilometer);
}

// Fonction pour effectuer la requête AJAX
function sendAjaxRequest(year, price, kilometer) {
    const xhr = new XMLHttpRequest();

    const url = `occasions.php?year=${encodeURIComponent(year)}&prix=${encodeURIComponent(price)}&kilometer=${encodeURIComponent(kilometer)}`;


    xhr.open('GET', url, true);

    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    const data = xhr.responseText;
    handleAjaxSuccess(data);
    } else if (xhr.readyState === 4 && xhr.status !== 200) {
    handleAjaxError(xhr.status, xhr.statusText);
    }
};

xhr.send();
}


// Fonction pour gérer le succès de la requête AJAX
function handleAjaxSuccess(data) {
    const results = JSON.parse(data);

    // Code pour générer le contenu HTML à partir des résultats
    let html = '';

    for (let i = 0; i < results.length; i++) {
        const car = results[i];
        // Générer le HTML pour chaque voiture
        html += '<div class="car">';
        html += '<p>year : ' + car.year + '</p>';
        html += '<p>kilometer : ' + car.kilometer + '</p>';
        html += '<p>price : ' + car.price + '</p>';
        html += '</div>';
    }

    // Mettre à jour la page avec les résultats
    document.querySelector('.car-list').innerHTML = html; // '.car-list' est la classe de la div où vous affichez les voitures
}

// Fonction pour gérer les erreurs de la requête AJAX
function handleAjaxError(xhr, status, error) {
    // Récupérer le message d'erreur à partir de la réponse HTTP
    const errorMessage = xhr.status + ': ' + xhr.statusText;

    // Sélectionner l'élément par son ID en JavaScript pur
    const errorElement = document.getElementById('error-message');

    // Mettre à jour le contenu de l'élément
    errorElement.textContent = 'Erreur de requête AJAX: ' + errorMessage;

    // Afficher l'élément
    errorElement.style.display = 'block';
}

// Attacher l'événement de soumission du formulaire lorsque le document est prêt
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('filter-form').addEventListener('submit', handleFormSubmit);
});
