<?php

namespace models;

use PDO;

class UsersRepository
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO("mysql:host=localhost;dbname=shop", "root", "root");
    }
    public function findAll()
    {
        $select = $this->bdd->prepare("SELECT * FROM users");
        $select->execute();

        return $select->fetchAll();
    }
}
