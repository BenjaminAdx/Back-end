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

    $reqUpdateArticle = $pdo->prepare("UPDATE Article SET title = ?, content = ? WHERE ID = ?");
    $reqUpdateArticle->execute(array($data["title"], $data["content"], $data["ID_ARTICLE"]));

    if (!empty($data["image"])) {
        $selectimg = $pdo->prepare("SELECT image FROM Article WHERE ID = ?");
        $selectimg->execute(array($data["ID_ARTICLE"]));
        $dataimg = $selectimg->fetch();
        unlink('imgarticle/' . $dataimg["image"]);
        $reqUpdateImg = $pdo->prepare("UPDATE Article SET image = ? WHERE ID = ?");
        $reqUpdateImg->execute(array($data["image"], $data["ID_ARTICLE"]));
    }

    $reqDelete = $pdo->prepare("DELETE FROM Article_temp WHERE ID = ?");
    $reqDelete->execute(array($ID));

    if ($_SESSION["ID_Role"] === 2) {
        header('Location: moderateur.php');
    } else {
        header("Location: admin.php");
    }
}
