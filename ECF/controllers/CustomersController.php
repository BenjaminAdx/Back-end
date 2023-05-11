<?php

namespace controllers;

use models\CustomersRepository;
use models\UsersRepository;

class CustomersController
{
    private $connexion;
    private $client;

    public function __construct()
    {
        $this->connexion = new UsersRepository();
        $this->client = new CustomersRepository;
    }
    public function customers()
    {

        $this->connexion->checkConnexion($_SESSION["id"]);
        $result = $this->client->findAll();
        $page = "views/Customers.phtml";
        require_once "views/Base.phtml";
    }
    public function register()
    {

        $this->connexion->checkConnexion($_SESSION["id"]);
        $page = "views/Register.phtml";
        require_once "views/Base.phtml";
    }
    public function registerPost()
    {

        $this->connexion->checkConnexion($_SESSION["id"]);
        $register = $this->client->registerCustomer($_POST["nom"], $_POST["prenom"], $_POST["adresse1"], $_POST["adresse2"], $_POST["code"], $_POST["ville"], $_POST["email"], $_POST["telephone"]);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
}
