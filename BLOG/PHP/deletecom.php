<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM Commentaires WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    $article = $data["ID_Article"];
    if ($_SESSION["ID"] !== $data["ID_User"] && $_SESSION["ID_Role"] < 2) {

        header("Location: deconnexion.php");
    } else {
        $req = $pdo->prepare("DELETE FROM Commentaires WHERE ID = ?");
        $req->execute(array($ID));
        header("Location: articlepublicate.php?id='$article'");
    }
}
