<?php

namespace models;

use PDO;

class UsersRepository
{

    protected PDO $bdd;

    public function __construct()
    {
        $this->bdd = \config\Database::getpdo();
    }
    public function findUser($user)
    {
        $select = $this->bdd->prepare("SELECT * FROM personnel WHERE nom = ?");
        $select->execute(array($user));

        return $select->fetch();
    }
    public function checkPassword($result, $password)
    {
        if (password_verify($password, $result["password"])) {
            $_SESSION["id"] = $result["id"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["nom"] = $result["nom"];
            return true;
        } else {
            return false;
        }
    }
}
