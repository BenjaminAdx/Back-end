<?php

namespace controllers;

use models\CustomersRepository;
use models\FacturesRepository;
use models\ProduitsRepository;
use models\UsersRepository;

class FacturesController
{
    private $connexion;
    private $facture;
    private $client;
    private $produit;

    public function __construct()
    {
        $this->connexion = new UsersRepository();
        $this->facture = new FacturesRepository();
        $this->client = new CustomersRepository();
        $this->produit = new ProduitsRepository();
    }

    public function facture($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $result = $this->produit->findAll();
        echo json_encode($result);
    }

    public function createFacture($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $page = "views/Factures.phtml";
        require_once "views/Base.phtml";
    }
    public function createFacturePost($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);

        $idFacture = $this->facture->newFacture($id, $_SESSION["id"]);
        $tableau = $this->facture->factureTableau($_POST);
        foreach ($tableau as $tableau2) {
            $this->facture->ligneFacture($tableau2["quantite"], $tableau2["produit"], $idFacture);
            $this->produit->modStock($tableau2["quantite"], $tableau2["produit"]);
        }
        $join = $this->facture->selectJoinFacture($idFacture);
        $price = $this->facture->calculPrice($join);
        $this->facture->modFacture($price[0], $price[1], $idFacture);

        return header("Location: /Back-end/ECF/Factures/showFactureDetail/$idFacture");
    }
    public function showFactures($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $result = $this->facture->findAllByClient($id);
        $data = $this->client->find($id);
        $page = "views/FacturesClients.phtml";
        require_once "views/Base.phtml";
    }
    public function showFactureDetail($idf)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $resFacture = $this->facture->findAllByFacture($idf);
        $resProduit = $this->facture->selectJoinFacture($idf);
        $resClient = $this->client->find($resFacture["id_clients"]);
        require_once "views/FactureDetail.phtml";
    }
}
