<?php
session_start();

require_once("bdd.php");

if (isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET["to"]) && !empty($_GET["to"])) {
    $token = $_GET["to"];
    $select = $pdo->prepare("SELECT * FROM User WHERE code = ?");
    $select->execute(array($token));
    $row = $select->rowCount();
    if ($row) {
        $data = $select->fetch();
        $ID = $data["ID"];
        $time = $data["expiration_time"];
        if (time() < $time) {
            $_SESSION["token"] = $token;
            header("Location: newpassword.php?id='$ID'");
        } else {
            $delete = $pdo->prepare("UPDATE User SET code = NULL, expiration_time = NULL WHERE ID = ?");
            $delete->execute(array($ID));
            header("Location: connexion.php");
        }
    } else {
        header("Location: connexion.php");
    }
}
