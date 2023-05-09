<?php

namespace controllers;

use models\CustomersRepository;

class CustomersController
{
    public function customers()
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $customer = new CustomersRepository;
            $result = $customer->findAll();
            $page = "views/Customers.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function register()
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $page = "views/Register.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function registerPost()
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $customer = new CustomersRepository;
            $register = $customer->registerCustomer($_POST["nom"], $_POST["prenom"], $_POST["adresse1"], $_POST["adresse2"], $_POST["code"], $_POST["ville"], $_POST["email"], $_POST["telephone"]);
            return header("Location: /Back-end/ECF/Produits/Produits");
        }
    }
}
