<?php

namespace models;

use PDO;

class UsersRepository
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO("mysql:host=localhost;dbname=ecf", "root", "root");
    }
    public function findUser($user)
    {
        $select = $this->bdd->prepare("SELECT * FROM personnel WHERE nom = ?");
        $select->execute(array($user));

        return $select->fetch();
    }
}
