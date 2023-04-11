<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
$select->execute([$_SESSION["ID"]]);
$data = $select->fetch();

if ($data["avatar"] !== "avatar.jpg") {
    unlink('upload/' . $data["avatar"]);
}

$req = $pdo->prepare("DELETE FROM User WHERE ID = ?");
$req->execute([$_SESSION["ID"]]);
header('Location: index.php');
