<?php

namespace models;

use PDO;

class FacturesRepository
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO("mysql:host=localhost;dbname=ecf", "root", "root");
    }
    public function newFacture($idc, $idp)
    {
        $new = $this->bdd->prepare("INSERT INTO facture (date, prix_ht, prix_ttc, id_clients, id_personnel) VALUES (NOW(), 0.00, 0.00, ?, ?)");
        $new->execute(array($idc, $idp));
        return $id_facture = $this->bdd->lastInsertId();
    }
}
