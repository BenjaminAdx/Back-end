<?php

namespace controllers;

use models\ProduitsRepository;

class FacturesController
{
    public function facture($id)
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $result = $produit->findAll();
            echo json_encode($result);
            $page = "views/Factures.phtml";
            require_once "views/Base.phtml";
        }
    }
}
