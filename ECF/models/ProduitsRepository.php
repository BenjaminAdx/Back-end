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
    public function addProduct($name, $reference, $price_ht, $stock, $alerte, $id_tva)
    {
        $req = $this->bdd->prepare("INSERT INTO produits (name, reference, price_ht, stock, alerte, id_tva) VALUES (?,?,?,?,?,?)");
        $req->execute(array($name, $reference, $price_ht, $stock, $alerte, $id_tva));
        return $message = "produit ajouté avec succès";
    }
    public function deleteProduct($id)
    {
        $del = $this->bdd->prepare("DELETE FROM produits WHERE id = ?");
        $del->execute(array($id));
        return $message = "produit supprimé avec succès";
    }
    public function find($id)
    {
        $sel = $this->bdd->prepare("SELECT * FROM produits WHERE id = ?");
        $sel->execute(array($id));
        return $sel->fetch();
    }
    public function modProduct($name, $reference, $price_ht, $stock, $alerte, $id_tva, $id)
    {
        $mod = $this->bdd->prepare("UPDATE produits SET name = ?, reference = ?, price_ht = ?, stock = ?, alerte = ?, id_tva = ? WHERE id = ?");
        $mod->execute(array($name, $reference, $price_ht, $stock, $alerte, $id_tva, $id));
        return $message = "produit modifier avec succès";
    }
}
