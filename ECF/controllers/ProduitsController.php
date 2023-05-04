<?php

namespace controllers;

use models\ProduitsRepository;

class ProduitsController
{
    public function produits()
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF");
        } else {
            $data = new ProduitsRepository();
            $result = $data->findAll();
            $page = "views/Produits.phtml";
            require_once "views/Base.phtml";
        }
    }
}
