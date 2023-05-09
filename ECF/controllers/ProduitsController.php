<?php

namespace controllers;

use models\ProduitsRepository;

class ProduitsController
{
    public function produits()
    {
        if (!isset($_SESSION["id"])) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $result = $produit->findAll();
            $page = "views/Produits.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function ajoutProduits()
    {
        if (!isset($_SESSION["id"]) || ($_SESSION["role"] < 2)) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $page = "views/AjoutProduits.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function ajoutProduitsPost()
    {
        if (!isset($_SESSION["id"]) || ($_SESSION["role"] < 2)) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $register = $produit->addProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"]);
            return header("Location: /Back-end/ECF/Produits/Produits");
        }
    }
    public function suppressionProduits($id)
    {
        if (!isset($_SESSION["id"]) || ($_SESSION["role"] < 2)) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $supprimer = $produit->deleteProduct($id);
            return header("Location: /Back-end/ECF/Produits/Produits");
        }
    }
    public function modifierProduits($id)
    {
        if (!isset($_SESSION["id"]) || ($_SESSION["role"] < 2)) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $result = $produit->find($id);
            $page = "views/ModifierProduits.phtml";
            require_once "views/Base.phtml";
        }
    }
    public function modifierProduitsPost($id)
    {
        if (!isset($_SESSION["id"]) || ($_SESSION["role"] < 2)) {
            return header("Location: /Back-end/ECF/Users/deconnexion");
        } else {
            $produit = new ProduitsRepository();
            $mod = $produit->modProduct($_POST["name"], $_POST["reference"], $_POST["price_ht"], $_POST["stock"], $_POST["alerte"], $_POST["id_tva"], $id);
            return header("Location: /Back-end/ECF/Produits/Produits");
        }
    }
}
