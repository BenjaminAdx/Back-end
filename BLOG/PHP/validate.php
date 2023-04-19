<?php

session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    if ($_SESSION["ID_Role"] < 2) {
        header("Location: deconnexion.php");
    } else {
        $req = $pdo->prepare("UPDATE Article SET ID_Moderation = ? WHERE ID = ?");
        $req->execute(array(3, $ID));
        header('Location: user.php');
    }
}
