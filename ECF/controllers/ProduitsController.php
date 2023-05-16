<?php

namespace controllers;

use config\Middleware;
use models\ProduitsRepository;

class ProduitsController
{

    private $connexion;
    private $produit;

    public function __construct()
    {
        $this->connexion = new Middleware();
        $this->produit = new ProduitsRepository();
        if (!isset($_SESSION["id"])) {
            header("Location: /Back-end/ECF/Users/deconnexion");
            exit();
        }
    }
    public function produits()
    {

        $result = $this->produit->findAll();
        $page = "views/Produits.phtml";
        require_once "views/Base.phtml";
    }
    public function ajoutProduits()
    {

        $this->connexion->roleMiddleware($_SESSION["role"]);
        $page = "views/AjoutProduits.phtml";
        require_once "views/Base.phtml";
    }
    public function ajoutProduitsPost()
    {

        $this->connexion->roleMiddleware($_SESSION["role"]);
        $register = $this->produit->addProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"]);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
    public function suppressionProduits($id)
    {

        $this->connexion->roleMiddleware($_SESSION["role"]);
        $supprimer = $this->produit->deleteProduct($id);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
    public function modifierProduits($id)
    {

        $this->connexion->roleMiddleware($_SESSION["role"]);
        $result = $this->produit->find($id);
        $page = "views/ModifierProduits.phtml";
        require_once "views/Base.phtml";
    }
    public function modifierProduitsPost($id)
    {

        $this->connexion->roleMiddleware($_SESSION["role"]);
        $mod = $this->produit->modProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"], $id);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
}
