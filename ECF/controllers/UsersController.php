<?php

namespace controllers;

use models\FacturesRepository;
use models\ProduitsRepository;
use models\UsersRepository;

class UsersController
{
    private $user;
    private $facture;
    private $produit;

    public function __construct()
    {
        $this->user = new UsersRepository();
        $this->facture = new FacturesRepository();
        $this->produit = new ProduitsRepository();
    }
    public function index()
    {
        $page = "views/Index.phtml";
        require_once "views/Base.phtml";
    }
    public function indexPost()
    {
        $result = $this->user->findUser($_POST["name"]);
        if (password_verify($_POST["password"], $result["password"])) {
            $_SESSION["id"] = $result["id"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["nom"] = $result["nom"];
            return header("Location: /Back-end/ECF/Produits/Produits");
        } else {
            $erreur = "Mauvais mot de passe";
            $page = "views/Index.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function deconnexion()
    {
        session_destroy();
        return header("Location: /Back-end/ECF");
    }
    public function ventes()
    {
        $this->user->checkConnexion($_SESSION["id"]);
        $resultM = $this->facture->findAllByMonth($_SESSION["id"]);
        $resultY = $this->facture->findAllByYear($_SESSION["id"]);
        $priceM = $this->facture->calculPriceMY($resultM);
        $priceY = $this->facture->calculPriceMY($resultY);

        $page = "views/Ventes.phtml";
        require_once "views/Base.phtml";
    }
    public function ventesDay()
    {
        $this->user->checkConnexion($_SESSION["id"]);
        $this->user->checkRole($_SESSION["role"]);
        $resultD = $this->facture->findAllByDay();
        $priceD = $this->facture->calculPriceMY($resultD);

        $page = "views/VentesDay.phtml";
        require_once "views/Base.phtml";
    }
    public function ventesProduits()
    {
        $this->user->checkConnexion($_SESSION["id"]);
        $this->user->checkRole($_SESSION["role"]);
        $produits = $this->produit->findAll();
    }
}
