<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
$select->execute([$_SESSION["ID"]]);
$data = $select->fetch();

$select2 = $pdo->prepare("SELECT a.ID, a.title, m.etat FROM Article a JOIN Moderation m ON a.ID_Moderation = m.ID WHERE a.ID_User = ? ORDER BY m.etat;");
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
    <img src="./upload/<?= $data["avatar"]; ?>" alt="Photo profil de <?= $data["username"]; ?>"><br>

    <a href="create.php">Créer un article</a><br>
    <a href="updateuser.php?id='<?= $data["ID"] ?>'">Modifier le profil</a><br>
    <a href="deleteuser.php?id='<?= $data["ID"] ?>'" onclick="return confirm('Vous confirmez la suppression de votre profil ?');">Supprimer le profil</a><br>
    <a href="deconnexion.php">Se déconnecter</a><br>
    <?php if ($_SESSION["ID_Role"] === 2) : ?>
        <a href="moderateur.php">Page Moderateur</a><br>
    <?php endif; ?>
    <?php if ($_SESSION["ID_Role"] === 3) : ?>
        <a href="admin.php">Page Admin</a>
    <?php endif; ?>

    <h2>Mes Articles</h2>

    <?php foreach ($data2 as $fetch) : ?>
        <div class="article">
            <h3>Titre: <?= $fetch["title"] ?></h3>
            <h3>Etat: <?= $fetch["etat"] ?></h3>
            <a href="article.php?id='<?= $fetch["ID"] ?>'">Aperçu article</a>
        </div>
    <?php endforeach; ?>

</body>

</html>