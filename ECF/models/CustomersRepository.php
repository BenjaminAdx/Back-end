<?php

namespace models;

use PDO;

class CustomersRepository
{

    protected PDO $bdd;

    public function __construct()
    {
        $this->bdd = \config\Database::getpdo();
    }
    public function registerCustomer($nom, $prenom, $adresse1, $adresse2, $code, $ville, $email, $telephone)
    {
        $req = $this->bdd->prepare("INSERT INTO clients (nom, prenom, adresse1, adresse2, code_postal, ville, email, telephone) VALUES (?,?,?,?,?,?,?,?)");
        $req->execute(array($nom, $prenom, $adresse1, $adresse2, $code, $ville, $email, $telephone));

        return $message = "client ajouté avec succès";
    }
    public function findAll()
    {
        $select = $this->bdd->prepare("SELECT * FROM clients");
        $select->execute();
        return $select->fetchAll();
    }
    public function find($id)
    {
        $sel = $this->bdd->prepare("SELECT * FROM clients WHERE id = ?");
        $sel->execute(array($id));
        return $sel->fetch();
    }
}
