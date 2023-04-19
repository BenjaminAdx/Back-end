<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    if ($_SESSION["ID"] !== $data["ID_User"] && $_SESSION["ID_Role"] < 3) {

        header("Location: deconnexion.php");
    }
}


if ($data["avatar"] !== "avatar.jpg") {
    unlink('upload/' . $data["avatar"]);
}

$req = $pdo->prepare("DELETE FROM User WHERE ID = ?");
$req->execute(array($ID));
if ($_SESSION["ID_Role"] === 3) {
    header('Location: admin.php');
} else {
    header('Location: index.php');
}
