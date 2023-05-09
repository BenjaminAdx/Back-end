let url = window.location.href;
let urlParts = url.split("/");
let lastValue = urlParts[urlParts.length - 1];

let urlFetch = "Back-end/ECF/Factures/facture/" + lastValue;


fetch(urlFetch)
    .then(function (response) {
        return response.json();
    })
    .then(function (produits) {
        const ligneProduitEl = document.querySelector('.ligne_produit');
        const selectProduitEl = document.createElement('select');
        selectProduitEl.name = 'produits';

        produits.forEach((produit) => {
            const optionProduit = document.createElement('option');
            optionProduit.value = produit.id;
            optionProduit.innerText = produit.name;
            selectProduitEl.appendChild(optionProduit);
        });
        const quantiteInput = document.createElement('input');
        quantiteInput.type = 'number';
        quantiteInput.name = 'quantite';
        quantiteInput.required = true;


        ligneProduitEl.appendChild(selectProduitEl);
        ligneProduitEl.appendChild(quantiteInput);



        let indexligne = 2;

        const ajoutBtn = document.querySelector('.ajout_ligne');

        ajoutBtn.addEventListener('click', () => {

            const ligneProduit = document.createElement('div');
            ligneProduit.classList.add('ligne_produit_' + indexligne);

            const selectProduit = document.createElement('select');
            selectProduit.name = 'produits_' + indexligne;

            produits.forEach((produit) => {
                const optionProduit = document.createElement('option');
                optionProduit.value = produit.id;
                optionProduit.innerText = produit.name;
                selectProduit.appendChild(optionProduit);
            });

            const quantiteInput = document.createElement('input');
            quantiteInput.type = 'number';
            quantiteInput.name = 'quantite_' + indexligne;
            quantiteInput.required = true;

            ligneProduit.appendChild(selectProduit);
            ligneProduit.appendChild(quantiteInput);

            const formulaire = document.querySelector('form');
            formulaire.insertBefore(ligneProduit, ajoutBtn);

            indexligne++;
        })
    });