<?php

session_start();
require_once("bdd.php");

if (isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (!empty($_POST["idArticle"]) && !empty($_POST["idUser"])) {
    $idUser = $_POST["idUser"];
    $idArticle = $_POST["idArticle"];
    $req = $pdo->prepare("DELETE FROM Jaime WHERE ID_User = ? AND ID_Article = ?");
    $req->execute(array($idUser, $idArticle));
    $response = "Suppression du like effectué";
    $json = json_encode($data, JSON_PRETTY_PRINT);
    echo $json;
}
