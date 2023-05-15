<?php

namespace models;

use PDO;

class FacturesRepository
{

    protected PDO $bdd;

    public function __construct()
    {
        $this->bdd = \config\Database::getpdo();
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
    public function factureTableau($post)
    {
        for ($i = 1; $i <= count($post) / 2; $i++) {
            $sous_tableau = array(
                "produit" => $post["produit_" . $i],
                "quantite" => $post["quantite_" . $i]
            );
            $tableau[] = $sous_tableau;
        }
        return $tableau;
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
    public function findAll()
    {
        $select = $this->bdd->prepare("SELECT * FROM facture");
        $select->execute();
        return $select->fetchAll();
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
    public function findAllByDay()
    {
        $sel = $this->bdd->prepare('SELECT COUNT(id) as "nombre", SUM(prix_ht) as "total_ht", SUM(prix_ttc) as "total_ttc" FROM facture WHERE DAY(date) = DAY(NOW()) AND MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW())');
        $sel->execute();
        return $sel->fetch();
    }
    public function findAllByMonth($idp)
    {
        $sel = $this->bdd->prepare('SELECT COUNT(id) as "nombre", SUM(prix_ht) as "total_ht", SUM(prix_ttc) as "total_ttc" FROM facture WHERE MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW()) AND id_personnel = ?');
        $sel->execute(array($idp));
        return $sel->fetch();
    }
    public function findAllByYear($idp)
    {
        $sel = $this->bdd->prepare('SELECT COUNT(id) as "nombre", SUM(prix_ht) as "total_ht", SUM(prix_ttc) as "total_ttc" FROM facture WHERE YEAR(date) = YEAR(NOW()) AND id_personnel = ?');
        $sel->execute(array($idp));
        return $sel->fetch();
    }
    public function findAllByProduitByMonth()
    {
        $sel = $this->bdd->prepare('Select p.name, p.price_ht, SUM(l.quantité) AS "quantité", SUM(l.quantité * p.price_ht) AS "total" FROM produits p JOIN ligne_facture l ON p.id = l.id_produits JOIN facture f ON f.id = l.id_facture WHERE MONTH(f.date) = MONTH(NOW()) AND YEAR(f.date) = YEAR(NOW()) GROUP BY p.name, p.price_ht');
        $sel->execute();
        return $sel->fetchAll();
    }
    public function findAllByProduitByYear()
    {
        $sel = $this->bdd->prepare('Select p.name, p.price_ht, SUM(l.quantité) AS "quantité", SUM(l.quantité * p.price_ht) AS "total" FROM produits p JOIN ligne_facture l ON p.id = l.id_produits JOIN facture f ON f.id = l.id_facture WHERE YEAR(f.date) = YEAR(NOW()) GROUP BY p.name, p.price_ht');
        $sel->execute();
        return $sel->fetchAll();
    }
    public function findTvaByMonth()
    {
        $sel = $this->bdd->prepare('Select SUM(prix_ht) as "total_ht", SUM(prix_ttc) as "total_ttc", SUM(prix_ttc - prix_ht) as "total_tva" from facture WHERE MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW())');
        $sel->execute();
        return $sel->fetch();
    }
    public function findAllByVendeurByMonth()
    {
        $sel = $this->bdd->prepare('Select p.nom, SUM(f.prix_ht) AS "total_ht" FROM facture f JOIN personnel p ON f.id_personnel = p.id WHERE MONTH(f.date) = MONTH(NOW()) AND YEAR(f.date) = YEAR(NOW()) GROUP BY p.nom');
        $sel->execute();
        return $sel->fetchAll();
    }
    public function findAllByVendeurByYear()
    {
        $sel = $this->bdd->prepare('Select p.nom, SUM(f.prix_ht) AS "total_ht" FROM facture f JOIN personnel p ON f.id_personnel = p.id WHERE YEAR(f.date) = YEAR(NOW()) GROUP BY p.nom');
        $sel->execute();
        return $sel->fetchAll();
    }
}
