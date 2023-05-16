<?php

namespace controllers;

use models\CustomersRepository;

class CustomersController
{
    private $client;


    public function __construct()
    {
        $this->client = new CustomersRepository;
        if (!isset($_SESSION["id"])) {
            header("Location: /Back-end/ECF/Users/deconnexion");
            exit();
        }
    }
    public function customers()
    {

        $result = $this->client->findAll();
        $page = "views/Customers.phtml";
        require_once "views/Base.phtml";
    }
    public function register()
    {

        $page = "views/Register.phtml";
        require_once "views/Base.phtml";
    }
    public function registerPost()
    {

        $register = $this->client->registerCustomer($_POST["nom"], $_POST["prenom"], $_POST["adresse1"], $_POST["adresse2"], $_POST["code"], $_POST["ville"], $_POST["email"], $_POST["telephone"]);
        return header("Location: /Back-end/ECF/Produits/Produits");
    }
}
