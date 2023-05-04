<?php

namespace controllers;

use models\UsersRepository;

class UsersController
{
    public function index()
    {
        $page = "views/Index.phtml";
        require_once "views/Base.phtml";
    }
    public function indexPost()
    {
        $user = new UsersRepository();
        $result = $user->findUser($_POST["name"]);
        if (password_verify($_POST["password"], $result["password"])) {
            $_SESSION["id"] = $result["id"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["nom"] = $result["nom"];
            return header("Location: /Back-end/ECF/Produits/Produits");
        } else {
            $erreur = "Mauvais mot de passe";
            $page = "views/Index.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function deconnexion()
    {
        session_destroy();
        return header("Location: /Back-end/ECF");
    }
}
