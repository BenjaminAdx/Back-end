<?php

session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM Article WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    if ($_SESSION["ID"] !== $data["ID_User"]) {
        header("Location: deconnexion.php");
    } else {
        $req = $pdo->prepare("UPDATE Article SET ID_Moderation = ? WHERE ID = ?");
        $req->execute(array(2, $ID));
        header('Location: user.php');
    }
}
