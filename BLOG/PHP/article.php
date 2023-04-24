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
    if ($_SESSION["ID"] !== $data["ID_User"] && $_SESSION["ID_Role"] === 1) {

        header("Location: deconnexion.php");
    }
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
    <h1>Aperçu de votre article</h1>
    <div>
        <h2><?= $data["title"] ?></h2>
        <img src="./imgarticle/<?= $data["image"]; ?>" alt="Photo de l'article">
        <p><?= $data["content"] ?></p>
        <?php if ($data["ID_Moderation"] === 1) : ?>
            <a href="publicate.php?id='<?= $data["ID"] ?>'">Publier</a>
            <a href="deletearticle.php?id='<?= $data["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet article ?');">Supprimer</a>
        <?php endif; ?>
        <?php if ($data["ID_Moderation"] === 2 && $_SESSION["ID_Role"] > 1) : ?>
            <a href="validate.php?id='<?= $data["ID"] ?>'">Valider</a>
            <a href="deletearticle.php?id='<?= $data["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet article ?');">Supprimer</a>
        <?php endif; ?>
        <a href="updatearticle.php?id='<?= $data["ID"] ?>'">Modifier</a>
        <?php if ($_SESSION["ID"] === $ID) : ?>
            <a href="user.php">Retour à mon profil</a>
        <?php endif; ?>
        <?php if ($_SESSION["ID_Role"] === 2) : ?>
            <a href="moderateur.php">Retour page moderateur</a>
        <?php endif; ?>
        <?php if ($_SESSION["ID_Role"] === 3) : ?>
            <a href="admin.php">Retour page admin</a>
        <?php endif; ?>

    </div>

</body>

</html>