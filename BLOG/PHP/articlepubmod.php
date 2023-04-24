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
    $select2 = $pdo->prepare("SELECT * FROM Article WHERE ID = ?");
    $select2->execute(array($data["ID_ARTICLE"]));
    $data2 = $select2->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>

<body>
    <h2>Aperçu de l'article publié</h2>
    <div>
        <h2><?= $data2["title"] ?></h2>
        <img src="./imgarticle/<?= $data2["image"]; ?>" alt="Photo de l'article">
        <p><?= $data2["content"] ?></p>
        <h2>Aperçu de l'article modifié</h2>
        <h2><?= $data["title"] ?></h2>
        <img src="./imgarticle/<?= $data["image"]; ?>" alt="Photo de l'article">
        <p><?= $data["content"] ?></p>
        <a href="articlerejmod.php?id='<?= $data["ID"] ?>'">Rejeter</a>
        <a href="articlevalmod.php?id='<?= $data["ID"] ?>'">Valider les modifications</a>
        <?php if ($_SESSION["ID_Role"] === 2) : ?>
            <a href="moderateur.php">Retour page moderateur</a>
        <?php endif; ?>
        <?php if ($_SESSION["ID_Role"] === 3) : ?>
            <a href="admin.php">Retour page admin</a>
        <?php endif; ?>

    </div>

</body>

</html>