function load_data(query = '') {
    fetch('/get_data?search_query=' + query + '').then(function (response) {

        return response.json();

    }).then(function (responseData) {

        var html = '<ul class="list-group">';

        if (responseData.length > 0) {
            for (var count = 0; count < responseData.length; count++) {
                var regular_expression = new RegExp('(' + query + ')', 'gi');

                html += '<a href="#" class="list-group-item list-group-item-action" onclick="getText(this)">' + responseData[count].country_name.replace(regular_expression, '<span class="text-primary fw-bold">$1</span>') + '</a>';
            }
        }
        else {
            html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
        }

        html += '</ul>';

        document.querySelector("#search_result").innerHTML = html;

    });
}

var search_element = document.querySelector("#autocomplete_search");

/* Fonction à chaque entrée au clavier ("keyup") */
function onkeyup() {
    let query = search_element.value;

    load_data(query);
};

search_element.addEventListener("keyup", onkeyup);

/* Fonction au focus affichage de tous les autocomplete possible */

function onfocus() {

    let query = search_element.value;

    load_data(query);

};

search_element.addEventListener("focus", onfocus);

/* Fonction reset à la perte de focus */

function reset() {
    document.querySelector("#search_result").innerHTML = '';
}

search_element.addEventListener("blur", reset);

/* Fonction affichage un seul pays au click du pays */

function getText(event) {
    var country_name = event.textContent;

    console.log(country_name);

    document.querySelector("#autocomplete_search").value = country_name;

    document.querySelector("#search_result").innerHTML = '';
}





