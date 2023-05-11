<?php

namespace controllers;

use models\ProduitsRepository;
use models\UsersRepository;

class ProduitsController
{

    private $connexion;
    private $produit;

    public function __construct()
    {
        $this->connexion = new UsersRepository();
        $this->produit = new ProduitsRepository();
    }
    public function produits()
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $result = $this->produit->findAll();
        $page = "views/Produits.phtml";
        require_once "views/Base.phtml";
    }
    public function ajoutProduits()
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $this->connexion->checkRole($_SESSION["role"]);
        $page = "views/AjoutProduits.phtml";
        require_once "views/Base.phtml";
    }
    public function ajoutProduitsPost()
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $this->connexion->checkRole($_SESSION["role"]);
        $register = $this->produit->addProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"]);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
    public function suppressionProduits($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $this->connexion->checkRole($_SESSION["role"]);
        $supprimer = $this->produit->deleteProduct($id);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
    public function modifierProduits($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $this->connexion->checkRole($_SESSION["role"]);
        $result = $this->produit->find($id);
        $page = "views/ModifierProduits.phtml";
        require_once "views/Base.phtml";
    }
    public function modifierProduitsPost($id)
    {
        $this->connexion->checkConnexion($_SESSION["id"]);
        $this->connexion->checkRole($_SESSION["role"]);
        $mod = $this->produit->modProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"], $id);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
}
