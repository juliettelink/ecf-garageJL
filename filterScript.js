

document.addEventListener("DOMContentLoaded", function () {
    const yearInput = $("#year");
    const kilometerInput = $("#kilometer");
    const priceInput = $("#price");
    const carContainer = $("#car-container");
    const searchResults = $("#searchResults");

    // Affiche les valeurs actuelles des filtres
    const yearValue = $("#yearValue");
    const kilometerValue = $("#kilometerValue");
    const priceValue = $("#priceValue");

    // fonction pour le chemin de l'image
    function getCarImage(image) {
        if (!image) {
            return DEFAULT_IMAGE_FOLDER + 'null.jpg';
        } else {
            return CARS_IMAGES_FOLDER + encodeURIComponent(image);
        }
    }

    // fonction qui récupére et affiche les voitures filtrées
    function fetchCars() {
        const year = yearInput.val();
        const kilometer = kilometerInput.val();
        const price = priceInput.val();

    // donne la valeur réelle en fonction du filtre
        yearValue.text(year);
        kilometerValue.text(kilometer);
        priceValue.text(price);

        // effectue une requête pour recupérer les voitures filtrées depuis le serveur
        fetch(`fetch.php?year=${year}&kilometer=${kilometer}&price=${price}`)
            .then(response => response.json())
            .then(cars => {
                // efface le contenu
                carContainer.empty();
                //affiche les voitures
                cars.forEach(car => {
                    const imagePath = getCarImage(car.image1);
                    carContainer.append(`
                        <div class="col-md-4 my-2">
                            <div class="card">
                                <img src="${imagePath}" class="card-img" alt="${car.model}">
                                <div class="card-body">
                                    <h5 class="card-title">${car.model}</h5>
                                    <p class="card-text">Année : ${car.year}</p>
                                    <p class="card-text">${car.price} €</p>
                                    <p class="card-text">${car.kilometer} Km</p>
                                    <a href="occasion.php?id=${car.car_id}" class="btn btn-secondary">Détails</a>
                                </div>
                            </div>
                        </div>
                    `);
                });
            })
            .catch(error => console.error('Erreur :', error));
    }

    //écoute les changements dans les filtres
    yearInput.add(kilometerInput).add(priceInput).on("input", function () {
        fetchCars(); // appelle la fonction pour mettre à jour les voitures affichées
    });
});