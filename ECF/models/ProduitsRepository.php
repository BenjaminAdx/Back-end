<?php

namespace models;

use PDO;

class ProduitsRepository
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO("mysql:host=localhost;dbname=ecf", "root", "root");
    }
    public function findAll()
    {
        $select = $this->bdd->prepare("SELECT * FROM produits");
        $select->execute();

        return $select->fetchAll();
    }
}
