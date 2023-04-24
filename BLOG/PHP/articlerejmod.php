<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if ($_SESSION["ID_Role"] === 1) {
    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM Article_temp WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();

    if (!empty($data["image"])) {
        unlink('imgarticle/' . $data["image"]);
    }

    $req = $pdo->prepare("DELETE FROM Article_temp WHERE ID = ?");
    $req->execute(array($ID));

    if ($_SESSION["ID_Role"] === 2) {
        header('Location: moderateur.php');
    } else {
        header("Location: admin.php");
    }
}
