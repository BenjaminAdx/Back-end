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
        return $this->bdd->lastInsertId();
    }
    public function ligneFacture($quantite, $idp, $idf)
    {
        $insert = $this->bdd->prepare("INSERT INTO ligne_facture (quantité, id_produits, id_facture) VALUES (?,?,?)");
        $insert->execute(array($quantite, $idp, $idf));
    }
    public function selectJoinFacture($idf)
    {
        $select = $this->bdd->prepare("SELECT p.name, p.price_ht, t.taux, l.quantité FROM produits p JOIN ligne_facture l ON p.id = l.id_produits JOIN tva t ON p.id_tva = t.id WHERE l.id_facture = ?");
        $select->execute(array($idf));
        return $select->fetchAll();
    }
    public function calculPrice($join)
    {
        $totalHT = 0.00;
        $totalTTC = 0.00;
        foreach ($join as $res) {
            $totalHT += $res["price_ht"] * $res["quantité"];
            $totalTTC += $res["price_ht"] * $res["quantité"] * (1.00 + $res["taux"] / 100);
        }
        $price = array($totalHT, $totalTTC);
        return $price;
    }
    public function modFacture($HT, $TTC, $idf)
    {
        $mod = $this->bdd->prepare("UPDATE facture SET prix_ht = ?, prix_ttc = ? WHERE id = ?");
        $mod->execute(array($HT, $TTC, $idf));
    }
    public function findAllByClient($idc)
    {
        $sel = $this->bdd->prepare("SELECT * FROM facture WHERE id_clients = ?");
        $sel->execute(array($idc));
        return $sel->fetchAll();
    }
    public function findAllByFacture($idf)
    {
        $sel = $this->bdd->prepare("SELECT * FROM facture WHERE id = ?");
        $sel->execute(array($idf));
        return $sel->fetch();
    }
}
