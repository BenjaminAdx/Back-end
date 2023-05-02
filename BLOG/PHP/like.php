<?php

session_start();
require_once("bdd.php");

if (isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (!empty($_POST["idArticle"]) && !empty($_POST["idUser"])) {
    $idUser = $_POST["idUser"];
    $idArticle = $_POST["idArticle"];
    $req = $pdo->prepare("INSERT INTO Jaime (ID_User, ID_Article) VALUES (?,?)");
    $req->execute(array($idUser, $idArticle));
    $response = "OK";
    $json = json_encode($response, JSON_PRETTY_PRINT);
    echo $json;
}
