
class Facture {
    constructor() {
        this.url = window.location.href;
        this.urlParts = this.url.split("/");
        this.lastValue = this.urlParts[this.urlParts.length - 1];
        this.urlFetch = "/Back-end/ECF/Factures/facture/" + this.lastValue;
        this.produits = [];
        this.indexligne = 2;
    }

    fetchProduits() {
        fetch(this.urlFetch, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        })
            .then(response => response.json())
            .then(produits => {
                this.produits = produits;
                this.addFirstLigne();
                this.addLigneOnClick();
            })
            .catch(error => console.error(error));
    }

    addFirstLigne() {
        const ligneProduitEl = document.querySelector('.ligne_produit_1');
        const selectProduitEl = document.createElement('select');
        selectProduitEl.name = 'produit_1';

        this.produits.forEach((produit) => {
            const optionProduit = document.createElement('option');
            optionProduit.value = produit.id;
            optionProduit.innerText = produit.name;
            selectProduitEl.appendChild(optionProduit);
        });

        const quantiteInput = document.createElement('input');
        quantiteInput.type = 'number';
        quantiteInput.name = 'quantite_1';
        quantiteInput.required = true;

        ligneProduitEl.appendChild(selectProduitEl);
        ligneProduitEl.appendChild(quantiteInput);
    }

    addLigneOnClick() {
        const ajoutBtn = document.querySelector('.ajout_ligne');

        ajoutBtn.addEventListener('click', () => {
            const ligneProduit = document.createElement('div');
            ligneProduit.classList.add('ligne_produit_' + this.indexligne);

            const selectProduit = document.createElement('select');
            selectProduit.name = 'produit_' + this.indexligne;

            this.produits.forEach((produit) => {
                const optionProduit = document.createElement('option');
                optionProduit.value = produit.id;
                optionProduit.innerText = produit.name;
                selectProduit.appendChild(optionProduit);
            });

            const quantiteInput = document.createElement('input');
            quantiteInput.type = 'number';
            quantiteInput.name = 'quantite_' + this.indexligne;
            quantiteInput.required = true;

            ligneProduit.appendChild(selectProduit);
            ligneProduit.appendChild(quantiteInput);

            const formulaire = document.querySelector('form');
            formulaire.insertBefore(ligneProduit, ajoutBtn);

            this.indexligne++;
        })
    }
}

const facture = new Facture();
facture.fetchProduits();
