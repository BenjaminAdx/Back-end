<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
$select->execute([$_SESSION["ID"]]);
$data = $select->fetch();

$select2 = $pdo->prepare("SELECT * FROM Article WHERE ID_User = ?");
$select2->execute([$_SESSION["ID"]]);
$data2 = $select2->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Bienvenue</p>

    <h1>Page de <?= $data["username"]; ?></h1>
    <img src="./upload/<?= $data["avatar"]; ?>" alt="Photo profil de <?= $data["username"]; ?>">

    <a href="create.php">Créer un article</a>
    <a href="updateuser.php">Modifier le profil</a>
    <a href="deleteuser.php">Supprimer le profil</a>
    <a href="deconnexion.php">Se déconnecter</a>

    <h2>Mes Articles</h2>

    <?php foreach ($data2 as $fetch) : ?>
        <div class="article">
            <h3><?= $fetch["title"] ?></h3>
            <img src="./imgarticle/<?= $fetch["image"]; ?>" alt="Photo de l'article">
            <p><?= $fetch["content"] ?></p>
            <?php if ($fetch["ID_Moderation"] === 1) : ?>
                <a href="publicate.php?id='<?= $fetch["ID"] ?>'">Publier</a>
            <?php endif; ?>
            <a href="updatearticle.php?id='<?= $fetch["ID"] ?>'">Modifier</a>
            <a href="deletearticle.php?id='<?= $fetch["ID"] ?>'">Supprimer</a>
        </div>
    <?php endforeach; ?>

</body>

</html>