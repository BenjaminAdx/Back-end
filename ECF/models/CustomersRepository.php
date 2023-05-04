<?php

namespace models;

use PDO;

class CustomersRepository
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO("mysql:host=localhost;dbname=ecf", "root", "root");
    }
    public function registerCustomer($nom, $prenom, $adresse1, $adresse2, $code, $ville, $email, $telephone)
    {
        $select = $this->bdd->prepare("INSERT INTO clients (nom, prenom, adresse1, adresse2, code_postal, ville, email, telephone) VALUES (?,?,?,?,?,?,?,?)");
        $select->execute(array($nom, $prenom, $adresse1, $adresse2, $code, $ville, $email, $telephone));

        return $message = "client ajouté avec succès";
    }
}
