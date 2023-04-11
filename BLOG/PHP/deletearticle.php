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
    if ($_SESSION["ID"] !== $data["ID_User"] && $_SESSION["ID_Role"] !== 3) {

        header("Location: deconnexion.php");
    } else {

        if (!empty($data["image"])) {
            unlink('imgarticle/' . $data["image"]);
        }
        $req = $pdo->prepare("DELETE FROM Article WHERE ID = ?");
        $req->execute(array($ID));
        header('Location: user.php');
    }
}
