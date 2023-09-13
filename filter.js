
//alert("testfiltre")

document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const errorElement = document.getElementById('error-message');

    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const year = document.getElementById('year').value;
        const price = document.getElementById('price').value;
        const kilometer = document.getElementById('kilometer').value;

        sendAjaxRequest(year, price, kilometer);
    });

    function sendAjaxRequest(year, price, kilometer) {
        const xhr = new XMLHttpRequest();
        const url = `occasions.php?year=${encodeURIComponent(year)}&price=${encodeURIComponent(price)}&kilometer=${encodeURIComponent(kilometer)}`;
        
        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    handleAjaxSuccess(xhr.responseText);
                } else {
                    handleAjaxError(xhr.status, xhr.statusText);
                }
            }
        };

        xhr.send();
    }

    function handleAjaxSuccess(data) {
        try {
            const results = JSON.parse(data);
            updateCarList(results);
        } catch (error) {
            console.error("Erreur de parsing JSON : " + error);
            errorElement.textContent = "Erreur de parsing JSON";
            errorElement.style.display = 'block';
        }
    }

    function handleAjaxError(status, statusText) {
        console.error("Erreur AJAX : " + status + " - " + statusText);
        errorElement.textContent = 'Erreur de requête AJAX: ' + status + ' - ' + statusText;
        errorElement.style.display = 'block';
    }

    function updateCarList(cars) {
        const carList = document.querySelector('.car-list');
        let html = '';

        for (const car of cars) {
            html += '<div class="car">';
            html += '<p>year : ' + car.year + '</p>';
            html += '<p>kilometer : ' + car.kilometer + '</p>';
            html += '<p>price : ' + car.price + '</p>';
            html += '</div>';
        }

        carList.innerHTML = html;
    }
});
