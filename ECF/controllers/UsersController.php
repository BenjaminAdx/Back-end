<?php

namespace controllers;

use config\Middleware;
use models\FacturesRepository;
use models\UsersRepository;

class UsersController
{
    private $user;
    private $facture;
    private $connexion;

    public function __construct()
    {
        $this->user = new UsersRepository();
        $this->facture = new FacturesRepository();
        $this->connexion = new Middleware();
    }
    public function index()
    {
        $page = "views/Index.phtml";
        require_once "views/Base.phtml";
    }
    public function indexPost()
    {
        $result = $this->user->findUser($_POST["name"]);
        $message = $this->user->checkPassword($result, $_POST["password"]);
        if ($message) {
            header("Location: /Back-end/ECF/Produits/Produits");
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
        $this->connexion->authMiddleware($_SESSION["id"]);
        $resultM = $this->facture->findAllByMonth($_SESSION["id"]);
        $resultY = $this->facture->findAllByYear($_SESSION["id"]);

        $page = "views/Ventes.phtml";
        require_once "views/Base.phtml";
    }
    public function ventesDay()
    {
        $this->connexion->authMiddleware($_SESSION["id"]);
        $this->connexion->roleMiddleware($_SESSION["role"]);
        $resultD = $this->facture->findAllByDay();

        $page = "views/VentesDay.phtml";
        require_once "views/Base.phtml";
    }
    public function ventesProduits()
    {
        $this->connexion->authMiddleware($_SESSION["id"]);
        $this->connexion->roleMiddleware($_SESSION["role"]);
        $month = $this->facture->findAllByProduitByMonth();
        $tva = $this->facture->findTvaByMonth();
        $year = $this->facture->findAllByProduitByYear();

        $page = "views/VentesProduits.phtml";
        require_once "views/Base.phtml";
    }
    public function ventesVendeurs()
    {
        $this->connexion->authMiddleware($_SESSION["id"]);
        $this->connexion->roleMiddleware($_SESSION["role"]);
        $month = $this->facture->findAllByVendeurByMonth();
        $year = $this->facture->findAllByVendeurByYear();

        $page = "views/VentesVendeurs.phtml";
        require_once "views/Base.phtml";
    }
}
